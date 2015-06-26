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
    public function getList()
    {
        $slides = $this->dao->select('*')->from(TABLE_SLIDE)->orderBy('`order`')->fetchAll('id');

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
    public function create($image)
    {
        $slide = fixer::input('post')
            ->stripTags('summary', $this->config->allowedTags->front)
            ->add('image', $image)
            ->add('createdDate', helper::now())
            ->add('createdBy', $this->app->user->account)
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
        $image = $this->uploadImage();

        $slide = fixer::input('post')
            ->stripTags('summary', $this->config->allowedTags->front)
            ->setIf(!empty($image), 'image', $image)
            ->add('editedDate', helper::now())
            ->add('editedBy', $this->app->user->account)
            ->remove('files')
            ->get();

        $slide->label        = helper::jsonEncode(array_values($slide->label));
        $slide->buttonClass  = helper::jsonEncode(array_values($slide->buttonClass));
        $slide->buttonUrl    = helper::jsonEncode(array_values($slide->buttonUrl));
        $slide->buttonTarget = helper::jsonEncode(array_values($slide->buttonTarget));

        $this->dao->update(TABLE_SLIDE)
            ->data($slide, $skip = 'uid')
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
    public function uploadImage()
    {
        $fileTitles = array();
        $imageSize  = array('width' => 0, 'height' => 0);
        $maxSlideID = $this->dao->select('max(`id`) as maxID')->from(TABLE_SLIDE)->fetch('maxID');

        $files = $this->getUpload();
        foreach($files as $id => $file)
        {   
            if(strpos($this->config->file->allowed, ',' . $file['extension'] . ',') === false)
            {
                if(!move_uploaded_file($file['tmpname'], $this->app->getDataRoot() . $file['pathname'] . '.txt')) return false;
                $file['pathname'] .= '.txt';
                $file = $this->file->saveZip($file);
            }
            else
            {
                if(!move_uploaded_file($file['tmpname'], $this->app->getDataRoot() . $file['pathname'])) return false;
            }          

            if(in_array(strtolower($file['extension']), $this->config->file->imageExtensions, true))
            {
                $imageSize = $this->file->getImageSize($this->app->getDataRoot() . $file['pathname']);
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
        $image->webPath = 'data/' . $image->pathname;

        return $image->webPath;
    }

    /**
     * Get upload files. 
     * 
     * @access public
     * @return array
     */
    public function getUpload()
    {
        $maxFileID  = $this->dao->select('max(`id`) as maxID')->from(TABLE_FILE)->fetch('maxID');
        $title = 'slide_' . ($maxFileID + 1);

        $files = array();
        if(!isset($_FILES['files'])) return $files;
        if(!$this->loadModel('file')->canUpload()) return $files;
        
        extract($_FILES['files']);
        foreach($name as $id => $filename)
        {
            if(empty($filename)) continue;
            if(!validater::checkFileName($filename)) continue;
            $file['extension'] = $this->file->getExtension($filename);
            $file['pathname']  = 'slides/' . $title . '.' . $file['extension'];
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

        if($slide->backgroundType == 'color') return !dao::isError();

        if(!dao::isError())
        {
            $pathname = str_replace('data/', '', $slide->image);
            $file = $this->dao->select('*')->from(TABLE_FILE)->where('objectType')->eq('slide')->andWhere('pathname')->eq($pathname)->fetch();
            $file->realPath = $this->app->getDataRoot() . $file->pathname;
            if(file_exists($file->realPath)) unlink($file->realPath);
            $this->dao->delete()->from(TABLE_FILE)->where('id')->eq($file->id)->exec();
            return !dao::isError();
        }
    }
}
