<?php
/**
 * The model file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class uiModel extends model
{
    /**
     * Get templates available.
     * 
     * @access public
     * @return void
     */
    public function getTemplates()
    {
        $this->app->loadClass('Spyc', true);
        $folders = glob($this->app->getTplRoot() . '*');
        foreach($folders as $folder)
        {
            $templateName = str_replace($this->app->getTplRoot(), '', $folder);
            $config = Spyc::YAMLLoadString(file_get_contents($folder . DS . 'doc' . DS . $this->app->getClientLang() . '.yaml'));
            if(empty($config)) continue;
            $templates[$templateName] = $config;
        }
        return $templates;
    }

    /**
     * Get authorities needed when install.
     * 
     * @access public
     * @return void
     */
    public function checkAuthorities()
    {
        $authorities = array();

        $authorities['package']['path']     = $this->app->getDataRoot() . 'template' . DS;
        $authorities['package']['exists']   = is_dir($authorities['package']['path']);
        $authorities['package']['writable'] = is_writable($authorities['package']['path']);

        $authorities['template']['path']     = $this->app->getTplRoot();
        $authorities['template']['exists']   = is_dir($authorities['template']['path']);
        $authorities['template']['writable'] = is_writable($authorities['template']['path']);

        $errors = '';
        $commands = '';
        foreach($authorities as $authority)
        {
            if(!$authority['exists'])  
            {
                $errors   .= sprintf($this->lang->ui->template->error->exists, $authority['path']);
                $commands .= sprintf($this->lang->ui->template->commands->exists, $authority['path']);
            }
            if(!$authority['writable']) 
            {
                $errors   .= sprintf($this->lang->ui->template->error->writable, $authority['path']);
                $commands .= sprintf($this->lang->ui->template->commands->writable, $authority['path']);
            }
        }

        return array($errors, $commands);
    }

    /**
     * Extract template package.
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function extractPackage($package)
    {
        $packageFile = $this->app->getDataRoot() . "template/{$package}.zip";

        $this->app->loadClass('pclzip', true);
        $zip = new pclzip($packageFile);
        $files = $zip->listContent();

        $tempPath = $this->app->getDataRoot() . 'template/' . $package . DS;

        if(is_dir($tempPath))
        {
            $fileClass = $this->app->loadClass('zfile');
            $fileClass->removeDir($tempPath);
        }

        $return = new stdclass();
        $removePath = $files[0]['filename'];
        if($zip->extract(PCLZIP_OPT_PATH, $tempPath, PCLZIP_OPT_REMOVE_PATH, $removePath) == 0)
        {
            $return->result = 'fail';
            $return->error  = $zip->errorInfo(true);
        }
        return true;
    }

    /**
     * Get info from template package. 
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function getInfoFromPackage($package)
    {
        $this->app->loadClass('Spyc', true);
        $tempPath = $this->app->getDataRoot() . 'template/' . $package . DS;
        return Spyc::YAMLLoadString(file_get_contents($tempPath . 'doc' . DS . $this->app->getClientLang() . '.yaml'));
    }

    /**
     * Copy package files. 
     * 
     * @param  string    $package 
     * @access public
     * @return array
     */
    public function copyTemplateFiles($package)
    {
        $templateRoot = $this->app->getTplRoot();
        $packagePath  = $this->app->getDataRoot() . 'template' . DS . $package . DS;

        $pathes = scandir($packagePath);

        $fileClass   = $this->app->loadClass('zfile');
        $copiedFiles = $fileClass->copyDir($packagePath, $templateRoot . $package);

        $fileClass = $this->app->loadClass('zfile');
        $fileClass->removeDir($packagePath);

        return $copiedFiles;
    }

    /**
     * Get template option menu.   
     * 
     * @access public
     * @return void
     */
    public function getTemplateOptions()
    {
        $this->app->loadClass('Spyc', true);
        $folders = glob($this->app->getTplRoot() . '*');
        foreach($folders as $folder)
        {
            $templateName = str_replace($this->app->getTplRoot(), '', $folder);
            $config = Spyc::YAMLLoadString(file_get_contents($folder . DS . 'doc' . DS . $this->app->getClientLang() . '.yaml'));
            $templates[$templateName] = $config['name'];
        }

        return $templates;
    }

    /**
     * Set UI option with file. 
     * 
     * @param  int    $type 
     * @param  int    $htmlTagName 
     * @access public
     * @return void
     */
    public function setOptionWithFile($section, $htmlTagName, $allowedFileType = 'jpg,jpeg,png,gif,bmp')
    {
        if(empty($_FILES)) return array('result' => false, 'message' => $this->lang->ui->noSelectedFile);

        $fileType = substr($_FILES['files']['name'], strrpos($_FILES['files']['name'], '.') + 1); 
        if(strpos($allowedFileType, $fileType) === false) return array('result' => false, 'message' => sprintf($this->lang->ui->notAlloweFileType, $allowedFileType));

        $fileModel = $this->loadModel('file');

        if(!$this->file->checkSavePath()) return array('result' => false, 'message' => $this->lang->file->errorUnwritable);

        /* Delete old files. */
        $oldFiles = $this->dao->select('id')->from(TABLE_FILE)->where('objectType')->eq($section)->fetchAll('id');
        foreach($oldFiles as $file) $fileModel->delete($file->id);
        if(dao::isError()) return array('result' => false, 'message' => $this->lang->fail);

        /* Upload new logo. */
        $uploadResult = $fileModel->saveUpload($htmlTagName);
        if(!$uploadResult) return array('result' => false, 'message' => $this->lang->fail);

        $fileIdList = array_keys($uploadResult);
        $file       = $fileModel->getById($fileIdList[0]); 

        /* Save new data. */
        $setting  = new stdclass();
        $setting->fileID    = $file->id;
        $setting->pathname  = $file->pathname;
        $setting->webPath   = $file->webPath;
        $setting->addedBy   = $file->addedBy;
        $setting->addedDate = $file->addedDate;

        $result = $this->loadModel('setting')->setItems('system.common.site', array($section => helper::jsonEncode($setting)));
        if($result) return array('result' => true);

        return array('result' => false, 'message' => $this->lang->fail);
    }

    /**
     * Create html of color plates list.
     *
     * @param string       $plates
     * return string 
     */
    public function createColorPlates($plates = '')
    {
        if(empty($plates))
        {
            $plates = $this->lang->ui->theme->colorPlates;
        }

        $colorPlates = '';
        foreach (explode('|', $plates) as $value)
        {
            $colorPlates .= "<div class='color color-tile' data='{$value}' data-toggle='tooltip' title='{$value}'><i class='icon-ok'></i></div>";
        }
        return $colorPlates;
    }

    /**
     * Print html of color input cell.
     *
     * @param string       $name
     * @param string       $value
     * @param string       $label
     * @param string       $default
     * @param string       $class
     * @param string       $alias
     * @param string       $tooltip
     * return string 
     */
    public function printColorInput($name, $value, $label = '', $default = '%AUTO%', $class = '', $alias= '', $tooltip = '%DEFAULT%')
    {
        if($default == '%AUTO%')
        {
            $default = $value;
        }
        if($tooltip == '%DEFAULT%')
        {
            $tooltip = $this->lang->ui->theme->colorTip;
        }
        $placeholder = ($default == 'transparent' ? $this->lang->ui->theme->transparent : $default);

        $html = "<div class='colorplate'>\n";
        $html .= "<div class='input-group color active' data='{$default}'>\n";
        $html .= "<span class='input-group-btn'>\n";
        $html .= "<button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>\n";
        $html .= "{$label} <span class='caret'></span>\n</button>\n";
        $html .= "<div class='dropdown-menu colors'>" . $this->createColorPlates() . "</div>\n</span>\n";
        $html .= "<input id='{$name}' name='{$name}' type='text' value='{$value}' data-default='{$default}' placeholder='{$placeholder}' class='form-control input-color text-latin {$class}' {$alias}" . (empty($tooltip) ? "" : " title='{$tooltip}' data-toggle='tooltip'") . ">\n";
        $html .= "</div>\n</div>\n";
        echo $html;
    }

    /**
     * Print html of textbox with label.
     *
     * @param string       $name
     * @param string       $value
     * @param string       $startLabel
     * @param string       $endLabel
     * @param string       $placeholder
     * @param string       $class
     * @param string       $alias
     * @param string       $tooltip
     * return string 
     */
    public function printTextbox($name, $value, $startLabel = '', $endLabel = '', $placeholder = '%AUTO%', $class = '', $alias = '', $tooltip = '')
    {
        if($placeholder == '%AUTO%')
        {
            $placeholder = $value;
        }

        $html = "<div class='input-group'>\n";
        if(!empty($startLabel))
        {
            $html .= "<span class='input-group-addon'>{$startLabel}</span>\n";
        }

        $html .= "<input id='{$name}' name='{$name}' type='text' value='{$value}' placeholder='{$placeholder}' class='form-control input-color text-latin {$class}' {$alias}" . (empty($tooltip) ? "" : " title='{$tooltip}' data-toggle='tooltip'") . ">\n";

        if(!empty($endLabel))
        {
            $html .= "<span class='input-group-addon'>{$endLabel}</span>\n";
        }
        $html .= "</div>\n";
        echo $html;
    }

    /**
     * Print html of select with input group
     *
     * @param string       $list
     * @param string       $name
     * @param string       $startLabel
     * @param string       $value
     * @param string       $label
     * @param string       $class
     * @param string       $alias
     * @param string       $tooltip
     * return string 
     */
    public function printSelectList($list, $name, $value = '', $label = '', $class = '', $alias = '', $tooltip = '')
    {
        $html = "<div class='input-group'>\n";
        if(!empty($label))
        {
            $html .= "<span class='input-group-addon'>{$label}</span>\n";
        }

        $html .= html::select($name, $list, $value, "class='form-control {$class}' {$alias}" . (empty($tooltip) ? "" : " title='{$tooltip}' data-toggle='tooltip'")) . "\n";

        $html .= "</div>\n";
        echo $html;
    }

    /**
     * Print html of inputgroup with two textbox cell
     *
     * @param string       $labelStart
     * @param string       $name1
     * @param string       $value1
     * @param string       $label1
     * @param string       $name2
     * @param string       $value2
     * @param string       $label2
     * @param string       $labelEnd
     * @param string       $placeholder1
     * @param string       $placeholder2
     * @param string       $tooltip1
     * @param string       $tooltip2
     * @param string       $alias1
     * @param string       $alias2
     * return string 
     */
    public function printTextboxCouple($labelStart, $name1, $value1, $label1, $name2, $value2, $label2, $labelEnd, $placeholder1 = '%AUTO%', $placeholder2 = '%AUTO%', $tooltip1 = '', $tooltip2 = '', $alias1 = '', $alias2 = '')
    {
        if($placeholder1 == '%AUTO%')
        {
            $placeholder1 = $value1;
        }
        if($placeholder2 == '%AUTO%')
        {
            $placeholder2 = $value2;
        }

        $html = "<div class='input-group'>\n";
        if(!empty($labelStart))
        {
            $html .= "<span class='input-group-addon'>{$labelStart}</span>\n";
        }

        if(!empty($label1))
        {
            $html .= "<span class='input-group-addon" . (empty($labelStart) ? '' : " fix-border") . "'>{$label1}</span>\n";
        }

        $html .= "<input id='{$name1}' name='{$name1}' type='text' value='{$value1}' placeholder='{$placeholder1}' class='form-control input-color text-latin' {$alias1}" . (empty($tooltip1) ? "" : " title='{$tooltip1}' data-toggle='tooltip'") . ">";

        if(!empty($label2))
        {
            $html .= "<span class='input-group-addon fix-border'>{$label2}</span>\n";
        }
        else
        {
            $html .= "<span class='input-group-addon fix-border fix-padding'></span>\n";
        }

        $html .= "<input id='{$name2}' name='{$name2}' type='text' value='{$value2}' placeholder='{$placeholder2}' class='form-control input-color text-latin' {$alias2}" . (empty($tooltip2) ? "" : " title='{$tooltip2}' data-toggle='tooltip'") . ">\n";

        if(!empty($endLabel))
        {
            $html .= "<span class='input-group-addon'>{$endLabel}</span>\n";
        }
        $html .= "</div>\n";
        echo $html;
    }

    /**
     * Print input group controls for background setting
     *
     * @param string       $title
     * @param string       $valueSetting
     * @param string       $commonName
     * return string 
     */
    public function printBackgroundInputs($title, $valueSetting,  $commonName = '', $defaultColor = 'transparent')
    {
        if(empty($commonName))
        {
            $backColorName          = 'backColor';
            $backImageName          = 'backImage';
            $backImageRepeatName    = 'backImageRepeat';
            $backImagePositionXName = 'backImagePositionX';
            $backImagePositionYName = 'backImagePositionY';
        }
        else
        {
            $backColorName          = $commonName . 'BackColor';
            $backImageName          = $commonName . 'BackImage';
            $backImageRepeatName    = $commonName . 'BackImageRepeat';
            $backImagePositionXName = $commonName . 'BackImagePositionX';
            $backImagePositionYName = $commonName . 'BackImagePositionY';
        }
        echo "<th>{$title}</th>\n";
        echo "<td>\n";
        $this->printColorInput($backColorName, $valueSetting[$backColorName], $this->lang->ui->theme->backColor, $defaultColor);
        echo "</td>\n";

        echo "<td>\n";
        $this->printTextbox($backImageName, $valueSetting[$backImageName], $this->lang->ui->theme->backImage, '', $this->lang->ui->theme->none, '', "data-default='none' data-type='image'", $this->lang->ui->theme->backImageTip);
        echo "</td>\n";

        echo "<td>\n";
        $this->printSelectList($this->lang->ui->theme->imageRepeatList, $backImageRepeatName, $themeSetting[$backImageRepeatName], $this->lang->ui->theme->imageRepeat);
        echo "</td>\n";

        echo "<td>\n";
        $this->printTextboxCouple($this->lang->ui->theme->position, $backImagePositionXName, $valueSetting[$backImagePositionXName], 'X', $backImagePositionYName, $valueSetting[$backImagePositionYName], 'Y', '', '0%', '0%', $this->lang->ui->theme->positionTip, $this->lang->ui->theme->positionTip);
        echo "</td>\n";
    }

    /**
     * Print input group controls for font setting
     *
     * @param string       $title
     * @param string       $valueSetting
     * @param string       $commonName
     * return string 
     */
    public function printTextStyleInputs($title, $valueSetting,  $commonName = '', $defaultColor = '#333', $defaultFont = 'inherit', $defaultFontSize = 'inherit')
    {
        if(empty($commonName))
        {
            $textColorName  = 'textColor';
            $fontSizeName   = 'fontSize';
            $fontFamilyName = 'font';
            $fontWeightName = 'fontWeight';
        }
        else
        {
            $textColorName  = $commonName . 'Color';
            $fontSizeName   = $commonName . 'FontSize';
            $fontFamilyName = $commonName . 'Font';
            $fontWeightName = $commonName . 'FontWeight';
        }

        echo "<th>{$title}</th>\n";
        echo "<td>\n";
        $this->printColorInput($textColorName, $valueSetting[$textColorName], $this->lang->ui->theme->color, $defaultColor);
        echo "</td>\n";

        echo "<td>\n";
        if(empty($valueSetting[$fontSizeName]))
        {
            $valueSetting[$fontSizeName] =  $defaultFontSize;
        }
        $this->printSelectList($this->lang->ui->theme->fontSizeList, $fontSizeName, $valueSetting[$fontSizeName], $this->lang->ui->theme->fontSize, '', empty($commonName) ? '' : "data-default='{$defaultFontSize}'");
        echo "</td>\n";

        echo "<td>\n";
        if(empty($valueSetting[$fontFamilyName]))
        {
            $valueSetting[$fontFamilyName] =  $defaultFont;
        }
        $this->printSelectList($this->lang->ui->theme->fontList, $fontFamilyName, $valueSetting[$fontFamilyName], $this->lang->ui->theme->font, '', empty($commonName) ? '' : "data-default='{defaultFont}'");
        echo "</td>\n";

        echo "<td>\n";
        $this->printSelectList($this->lang->ui->theme->fontWeightList, $fontWeightName, $valueSetting[$fontWeightName], $this->lang->ui->theme->fontWeight, "data-default='inherit'");
        echo "</td>\n";
    }

    /**
     * Print input group controls for border setting
     *
     * @param string       $title
     * @param string       $valueSetting
     * @param string       $commonName
     * return string 
     */
    public function printBorderInputs($title, $valueSetting,  $commonName = '', $defaultStyle = 'none', $defaultColor = 'transparent', $defaultWidth = '1px', $defaultRadius = '0')
    {
        if(empty($commonName))
        {
            $borderStyleName  = 'borderStyle';
            $borderColorName   = 'borderColor';
            $borderWidthName = 'borderWidth';
            $borderRadiusName = 'borderRadius';
        }
        else
        {
            $borderStyleName  = $commonName . 'BorderStyle';
            $borderColorName   = $commonName . 'BorderColor';
            $borderWidthName = $commonName . 'BorderWidth';
            $borderRadiusName = $commonName . 'BorderRadius';
        }

        echo "<th>{$title}</th>\n";
        echo "<td>\n";
        $this->printSelectList($this->lang->ui->theme->borderStyleList, $borderStyleName, $valueSetting[$borderStyleName], $this->lang->ui->theme->borderStyle, '', "data-default='{$defaultStyle}'");
        echo "</td>\n";

        echo "<td>\n";
        $this->printColorInput($borderColorName, $valueSetting[$borderColorName], $this->lang->ui->theme->color, $defaultColor);
        echo "</td>\n";

        echo "<td>\n";
        $this->printTextbox($borderWidthName, $themeSetting[$borderWidthName], $this->lang->ui->theme->width, '', $defaultWidth, '', "data-type='size'");
        echo "</td>\n";

        echo "<td>\n";
        $this->printTextbox($borderRadiusName, $themeSetting[$borderRadiusName], $this->lang->ui->theme->radius, '', $defaultRadius, '', "data-type='size'");
        echo "</td>\n";
    }
}
