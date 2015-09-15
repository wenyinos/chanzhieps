<?php
/**
 * The control file of log of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     log
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class log extends control
{
    public function record()
    {
       $visitor = $this->log->saveVisitor();
       $referer = $this->log->saveReferer();
       $this->log->saveReport($visitor, $referer);
       $this->log->saveRegin();
       exit('success');
    }
}
