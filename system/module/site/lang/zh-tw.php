<?php
/**
 * The site module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->site->common        = "站點";

$lang->site->type            = '站點類型';
$lang->site->status          = '站點狀態';
$lang->site->pauseTip        = '暫停提示';
$lang->site->name            = '網站名稱';
$lang->site->module          = '功能模組';
$lang->site->lang            = '站點語言';
$lang->site->defaultLang     = '預設語言';
$lang->site->domain          = '主域名';
$lang->site->allowedDomain   = '可訪問域名';
$lang->site->keywords        = '關鍵詞';
$lang->site->indexKeywords   = '首頁關鍵詞';
$lang->site->meta            = 'Meta信息';
$lang->site->desc            = '站點描述';
$lang->site->icpSN           = '備案編號';
$lang->site->icpLink         = '備案連結';
$lang->site->slogan          = '站點口號';
$lang->site->mission         = '站點使命';
$lang->site->copyright       = '創建年份';
$lang->site->allowUpload     = '允許上傳附件';
$lang->site->allowedFiles    = '允許附件類型';
$lang->site->captcha         = '前台表單';
$lang->site->mailCaptcha     = '郵箱驗證碼';
$lang->site->twContent       = '繁體內容';
$lang->site->cn2tw           = '自動從簡體版複製';
$lang->site->cdn             = 'CDN地址';

$lang->site->importantOption = '重要操作';
$lang->site->checkIP         = '後台登錄IP白名單';
$lang->site->checkPosition   = '後台登錄地區驗證';
$lang->site->checkEmail      = '會員郵箱綁定';
$lang->site->allowedPosition = '允許登錄地區';
$lang->site->checkSessionIP  = '登錄期間IP';
$lang->site->setsecurity     = '安全設置';

$lang->site->setBasic      = "基本信息設置";
$lang->site->setLang       = "語言設置";
$lang->site->setSecurity   = "安全設置";
$lang->site->setUpload     = "檔案上傳設置";
$lang->site->setRobots     = "Robots 設置";
$lang->site->setOauth      = "開放登錄設置";
$lang->site->setSinaOauth  = "新浪微博接入";
$lang->site->setQQOauth    = "QQ接入";
$lang->site->oauthHelp     = "使用幫助";
$lang->site->setRecPerPage = "列表數量設置";
$lang->site->usePosition   = "使用當前登錄地址: <span>%s</span>";

$lang->site->typeList = new stdclass();
$lang->site->typeList->portal = '企業門戶';
$lang->site->typeList->blog   = '個人博客';

$lang->site->statusList = new stdclass();
$lang->site->statusList->normal = '正常';
$lang->site->statusList->pause  = '暫停';

$lang->site->checkIPList = array();
$lang->site->checkIPList['open']  = '打開';
$lang->site->checkIPList['close'] = '關閉';

$lang->site->checkPositionList = array();
$lang->site->checkPositionList['open']  = '打開';
$lang->site->checkPositionList['close'] = '關閉';

$lang->site->checkEmailList = array();
$lang->site->checkEmailList['open']  = '打開';
$lang->site->checkEmailList['close'] = '關閉';

$lang->site->sessionIpoptions = array();
$lang->site->sessionIpoptions[0] = '可以改變';
$lang->site->sessionIpoptions[1] = '不允許改變';

$lang->site->captchaList = array();
$lang->site->captchaList['open']  = '不用驗證碼';
$lang->site->captchaList['close'] = '一直啟用驗證碼';
$lang->site->captchaList['auto']  = '有敏感內容時自動啟用驗證碼';

$lang->site->validateTypes = new stdclass();
$lang->site->validateTypes->okFile = 'ok.txt檔案驗證';
$lang->site->validateTypes->email  = '郵件驗證碼驗證';

$lang->site->moduleAvailable = array();
$lang->site->moduleAvailable['user']    = '會員';
$lang->site->moduleAvailable['forum']   = '論壇';
$lang->site->moduleAvailable['blog']    = '博客';
$lang->site->moduleAvailable['book']    = '手冊';
$lang->site->moduleAvailable['message'] = '評論留言';
$lang->site->moduleAvailable['search']  = '搜索';
$lang->site->moduleAvailable['shop']    = '商城';

$lang->site->metaHolder       = '可放置<meta><script><style>和<link>標籤。';
$lang->site->fileAllowedRole  = '多個尾碼名之間請用 "," 隔開';
$lang->site->domainTip        = '設置主域名可使所有網站訪問跳轉到該域名，設置前請確保主域名解析正確。該值為空時不進行跳轉。';
$lang->site->allowedDomainTip = '多個域名使用 , 隔開，如www.chanzhi.org,www.chanzhi.com。該值為空時允許所有域名訪問。';
$lang->site->allowedIPTip     = '多個IP使用 , 隔開，如202.194.133.1,202.194.132.0/28。允許所有IP訪問請留空。';
$lang->site->wrongAllowedIP   = 'IP 格式錯誤';
$lang->site->changePosition   = '您當前的登錄地區與允許登錄地區不一致。';
$lang->site->sessionIpTip     = '開啟後，因為某些運營商的IP不是固定的，IP變化後會自動退出蟬知。';

$lang->site->robots            = 'Robots';
$lang->site->robotsUnwriteable = 'Robots檔案%s 不可寫，請修改權限後設置。';
$lang->site->reloadForRobots   = '刷新頁面';
$lang->site->defaultTip        = '站點維護中……';
$lang->site->icpTip            = '';

$lang->site->setPage = new stdclass();
$lang->site->setPage->article = '文章列表';
$lang->site->setPage->product = '產品列表';
$lang->site->setPage->blog    = '博客列表';
$lang->site->setPage->forum   = '論壇列表';
$lang->site->setPage->reply   = '回帖列表';
$lang->site->setPage->message = '留言列表';
$lang->site->setPage->comment = '評論列表';
