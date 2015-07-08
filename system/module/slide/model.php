<?php
/**
 * The model file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class slideModel extends model
{
    /**
     * Get one slide by id.
     *
     * @param int $id
     * @access public
     * @return array
     */
    public function getByID($id)
    {
        $slide = $this->dao->select('*')->from(TABLE_SLIDE)->where('id')->eq($id)->fetch();

        $slide->label        = json_decode($slide->label);
        $slide->buttonClass  = json_decode($slide->buttonClass);
        $slide->buttonUrl    = json_decode($slide->buttonUrl);
        $slide->buttonTarget = json_decode($slide->buttonTarget);

        return $slide;
    }

    /**
     * Get slides list sorted by key.
     *
     * @access public
     * @return array
     */
    public function getList($groupID)
    {
        $slides = $this->dao->select('*')->from(TABLE_SLIDE)->where('`group`')->eq($groupID)->orderBy('`order`')->fetchAll('id');

        foreach($slides as $slide)
        {
            $slide->label        = json_decode($slide->label);
            $slide->buttonClass  = json_decode($slide->buttonClass);
            $slide->buttonUrl    = json_decode($slide->buttonUrl);
            $slide->buttonTarget = json_decode($slide->buttonTarget);
        }
        
        return $slides;
    }

    /**
     * Create a slide.
     *
     * @access public
     * @return bool
     */
    public function create($groupID, $image)
    {
        $slide = fixer::input('post')
            ->stripTags('summary', $this->config->allowedTags->front)
            ->add('group', $groupID)
            ->add('image', $image)
            ->add('createdDate', helper::now())
            ->remove('files')
            ->get();

        $maxOrder = $this->dao->select('max(`order`) as maxOrder')->from(TABLE_SLIDE)->fetch('maxOrder');
        $order = $maxOrder ? $maxOrder + 1 : 1;

        $slide->label        = helper::jsonEncode(array_values($slide->label));
        $slide->buttonClass  = helper::jsonEncode(array_values($slide->buttonClass));
        $slide->buttonUrl    = helper::jsonEncode(array_values($slide->buttonUrl));
        $slide->buttonTarget = helper::jsonEncode(array_values($slide->buttonTarget));
        $slide->order        = $order;

        $this->dao->insert(TABLE_SLIDE)
            ->data($slide, $skip = 'uid')
            ->batchCheckIF($this->post->backgroundType == 'color', $this->config->slide->require->create, 'notempty')
            ->checkIF($this->post->backgroundType == 'color', 'height', 'ge', 100)
            ->exec();

        return !dao::isError();
    }

    /**
     * Update a slide.
     *
     * @param int $id
     * @access public
     * @return bool
     */
    public function update($id)
    {
        $slide = $this->getByID($id);
        $image = $this->uploadImage($slide->group);

        $data = fixer::input('post')
            ->stripTags('summary', $this->config->allowedTags->front)
            ->setIf(!empty($image), 'image', $image)
            ->remove('files')
            ->get();

        $data->label        = helper::jsonEncode(array_values($data->label));
        $data->buttonClass  = helper::jsonEncode(array_values($data->buttonClass));
        $data->buttonUrl    = helper::jsonEncode(array_values($data->buttonUrl));
        $data->buttonTarget = helper::jsonEncode(array_values($data->buttonTarget));

        $this->dao->update(TABLE_SLIDE)
            ->data($data, $skip = 'uid')
            ->batchCheckIF($this->post->backgroundType == 'color', $this->config->slide->require->create, 'notempty')
            ->checkIF($this->post->backgroundType == 'color', 'height', 'ge', 100)
            ->where('id')->eq($id)
            ->exec();

        return !dao::isError();
    }

    /**
     * Sort slides
     *
     * @access public
     * @return bool
     */
    public function sort()
    {
        /* Count maxKey to avoid  duplicate entry system-common-slides-key. */
        $maxOrder = $this->dao->select('max(`order`) as maxOrder')->from(TABLE_SLIDE)->fetch('maxOrder');

        /* Reset key to zero to make sure key wouldnot overflow. */
        if($maxOrder > 1000) $maxOrder = 0;

        $orders = isset($_POST['order']) ? $_POST['order'] : array();
        foreach($orders as $id => $order)
        {
            /* Add maxKey to key ensure unique.*/
            $order = $maxOrder + $order;
            $this->dao->update(TABLE_SLIDE)->set('order')->eq($order)->where('id')->eq($id)->exec();
        }

        return !dao::isError();
    }

    /**
     * upload image for slide. 
     *
     * @access public
     * @return string webPath
     */
    public function uploadImage($groupID)
    {
        $fileTitles = array();
        $imageSize  = array('width' => 0, 'height' => 0);
        $maxSlideID = $this->dao->select('max(`id`) as maxID')->from(TABLE_SLIDE)->fetch('maxID');

        $files = $this->getUpload($groupID);
        foreach($files as $id => $file)
        {   
            $savePath = $this->app->getDataRoot() . 'upload/';
            if(strpos($this->config->file->allowed, ',' . $file['extension'] . ',') === false)
            {
                if(!move_uploaded_file($file['tmpname'], $savePath . $file['pathname'] . '.txt')) return false;
                $file['pathname'] .= '.txt';
                $file = $this->file->saveZip($file);
            }
            else
            {
                if(!move_uploaded_file($file['tmpname'], $savePath . $file['pathname'])) return false;
            }          

            if(in_array(strtolower($file['extension']), $this->config->file->imageExtensions, true))
            {
                $imageSize = $this->file->getImageSize($savePath . $file['pathname']);
            }

            $file['objectType'] = 'slide';
            $file['objectID']   = $maxSlideID + 1;
            $file['addedBy']    = $this->app->user->account;
            $file['addedDate']  = helper::now();
            $file['width']      = $imageSize['width'];
            $file['height']     = $imageSize['height'];
            $file['lang']       = 'all';
            unset($file['tmpname']);
            $this->dao->insert(TABLE_FILE)->data($file)->exec();
            $fileTitles[$this->dao->lastInsertId()] = $file['title'];
        }
        $this->loadModel('setting')->setItems('system.common.site', array('lastUpload' => time()));

        if(!$fileTitles) return false; 

        $imageIdList = array_keys($fileTitles);
        $image = $this->dao->select('*')->from(TABLE_FILE)->where('id')->eq($imageIdList[0])->fetch(); 
        $image->webPath = '/data/upload/' . $image->pathname;

        return $image->webPath;
    }

    /**
     * Get upload files. 
     * 
     * @access public
     * @return array
     */
    public function getUpload($groupID)
    {
        $maxFileID  = $this->dao->select('max(`id`) as maxID')->from(TABLE_FILE)->fetch('maxID');
        $title = 'group' . $groupID . '_slide' . ($maxFileID + 1);

        $files = array();
        if(!isset($_FILES['files'])) return $files;
        if(!$this->loadModel('file')->canUpload()) return $files;
        
        extract($_FILES['files']);
        foreach($name as $id => $filename)
        {
            if(empty($filename)) continue;
            if(!validater::checkFileName($filename)) continue;
            $file['extension'] = $this->file->getExtension($filename);
            $file['pathname']  = 'source/' . $title . '.' . $file['extension'];
            $file['title']     = $title;
            $file['size']      = $size[$id];
            $file['tmpname']   = $tmp_name[$id];
            $files[] = $file;
        }
        return $files;
    }

    /**
     * Delete a slide.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id, $table = null)
    {
        $slide = $this->getByID($id);
        $this->dao->delete()->from(TABLE_SLIDE)->where('id')->eq($id)->exec();

        return !dao::isError();
    }
}
