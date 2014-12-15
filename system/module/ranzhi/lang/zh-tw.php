<?php
/**
 * The ranzhi module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青島息壤網絡信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     ranzhi
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->ranzhi->id        = '編號';
$lang->ranzhi->type      = '類型';
$lang->ranzhi->name      = '微信名';
$lang->ranzhi->account   = '原始ID';
$lang->ranzhi->appID     = 'AppID';
$lang->ranzhi->appSecret = 'AppSecret';
$lang->ranzhi->token     = 'Token';
$lang->ranzhi->url       = '接入地址';
$lang->ranzhi->certified = '是否認證';
$lang->ranzhi->users     = '微信會員';
$lang->ranzhi->content   = '內容';
$lang->ranzhi->qrcode    = '二維碼';

$lang->ranzhi->create    = '添加公眾號';
$lang->ranzhi->edit      = '編輯公眾號';
$lang->ranzhi->admin     = '維護公眾號';
$lang->ranzhi->list      = '公眾號列表';
$lang->ranzhi->setMenu   = '菜單';
$lang->ranzhi->integrate = '接入';

$lang->ranzhi->typeList['subscribe'] = '訂閲號';
$lang->ranzhi->typeList['service']   = '服務號';

$lang->ranzhi->certifiedList[1] = '是';
$lang->ranzhi->certifiedList[0] = '否';

$lang->ranzhi->response = new stdclass();

$lang->ranzhi->response->keywords  = '關鍵字';
$lang->ranzhi->response->set       = '響應設置';
$lang->ranzhi->response->create    = '添加關鍵字';
$lang->ranzhi->response->default   = '預設響應';
$lang->ranzhi->response->subscribe = '訂閲響應';

$lang->ranzhi->response->type     = '類型';
$lang->ranzhi->response->source   = '來源';
$lang->ranzhi->response->module   = '模組';
$lang->ranzhi->response->block    = '內容';
$lang->ranzhi->response->link     = '連結';
$lang->ranzhi->response->category = '類目';
$lang->ranzhi->response->limit    = '數量';

$lang->ranzhi->response->list   = '響應列表';

$lang->ranzhi->response->typeList['link'] = '連結';
$lang->ranzhi->response->typeList['text'] = '文本消息';
$lang->ranzhi->response->typeList['news'] = '圖文消息';

$lang->ranzhi->response->sourceList['system'] = '系統';
$lang->ranzhi->response->sourceList['manual'] = '輸入';

$lang->ranzhi->response->moduleList['index']   = '首頁';
$lang->ranzhi->response->moduleList['company'] = '關於我們';
$lang->ranzhi->response->moduleList['blog']    = '博客';
$lang->ranzhi->response->moduleList['forum']   = '論壇';
$lang->ranzhi->response->moduleList['book']    = '手冊';
$lang->ranzhi->response->moduleList['manual']  = '自定義';

$lang->ranzhi->response->textBlockList['company'] = '公司簡介';
$lang->ranzhi->response->textBlockList['contact'] = '聯繫我們';
$lang->ranzhi->response->textBlockList['manual']  = '自定義';

$lang->ranzhi->response->newsBlockList['articleTree']   = '文章分類';
$lang->ranzhi->response->newsBlockList['latestArticle'] = '最新文章';
$lang->ranzhi->response->newsBlockList['hotArticle']    = '熱門文章';
$lang->ranzhi->response->newsBlockList['productTree']   = '產品分類';
$lang->ranzhi->response->newsBlockList['latestProduct'] = '最新產品';
$lang->ranzhi->response->newsBlockList['hotProduct']    = '熱門產品';

$lang->ranzhi->message = new stdclass();
$lang->ranzhi->message->from     = '稱呼';
$lang->ranzhi->message->type     = '類型';
$lang->ranzhi->message->status   = '狀態';
$lang->ranzhi->message->content  = '消息內容';
$lang->ranzhi->message->response = '響應';
$lang->ranzhi->message->menu     = '菜單';
$lang->ranzhi->message->time     = '時間';
$lang->ranzhi->message->reply    = '回覆';
$lang->ranzhi->message->record   = '消息記錄';
$lang->ranzhi->message->list     = '消息列表';

$lang->ranzhi->message->typeList['text']        = '文本';
$lang->ranzhi->message->typeList['image']       = '圖片';
$lang->ranzhi->message->typeList['voice']       = '語音';
$lang->ranzhi->message->typeList['location']    = '位置';
$lang->ranzhi->message->typeList['link']        = '連結';
$lang->ranzhi->message->typeList['subscribe']   = '訂閲';
$lang->ranzhi->message->typeList['unsubscribe'] = '取消訂閲';
$lang->ranzhi->message->typeList['scan']        = '掃瞄';
$lang->ranzhi->message->typeList['click']       = '點擊';
$lang->ranzhi->message->typeList['view']        = '連結';

$lang->ranzhi->message->tabList[] = 'mode=replied&replied=0|未回覆';
$lang->ranzhi->message->tabList[] = 'mode=type&type=text|留言';
$lang->ranzhi->message->tabList[] = 'mode=type&type=subscribe|新訂閲';
$lang->ranzhi->message->tabList[] = 'mode=type&type=unsubscribe|取消訂閲';
$lang->ranzhi->message->tabList[] = 'mode=replied&replied=1|已回覆';

$lang->ranzhi->noSelectedFile  = "沒有選擇圖片";
$lang->ranzhi->noAppID         = "沒有設置AppID";
$lang->ranzhi->qrcodeType      = "請上傳JPG格式二維碼圖片";

$lang->ranzhi->placeholder = new stdclass();
$lang->ranzhi->placeholder->limit    = '請輸條數，最多10條';
$lang->ranzhi->placeholder->category = '請選擇類目，最多10個';
$lang->ranzhi->placeholder->name     = '公眾號名稱';
$lang->ranzhi->placeholder->account  = '請輸入gh_xxx 格式的原始ID';
$lang->ranzhi->placeholder->token    = '必須為英文或數字，長度為3-32字元';

$lang->ranzhi->needCertified = "此功能需要公眾號認證後使用。";
$lang->ranzhi->integrateInfo = "請到微信的公眾平台完成接入，以獲取appID和appSecret信息。
                                <a href='http://api.chanzhi.org/goto.php?item=help_ranzhi' target='_blank'>幫助</a>";
$lang->ranzhi->integrateDone = "已完成接入";
