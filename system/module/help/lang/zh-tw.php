<?php
$lang->rmb                = '元';
$lang->help->common       = '在綫幫助系統';
$lang->help->books        = '手冊列表';
$lang->help->articles     = '文檔導航';
$lang->help->backtobooks  = '返回手冊列表';
$lang->help->successSaved = '保存成功';

$lang->help->id           = '編號';
$lang->help->field        = '欄位名';
$lang->help->explaination = '解釋';
$lang->help->comment      = "備註|可以填寫你相應的備註信息。";
$lang->help->labels       = "附件的名稱|如果你上傳的附件檔案名沒有含義，可以通過設置檔案的標題來方便讀取";
$lang->help->namenotempty = '名稱不能為空';
$lang->help->codenotempty = '編碼不能為空';
$lang->help->codeunique   = '此編碼已經存在';
$lang->help->codealnum  = '編碼必須為英文字母或者數字';

$lang->book = new stdclass();
$lang->book->create        = '添加手冊';
$lang->book->edit          = '編輯手冊';
$lang->book->id            = '編號';
$lang->book->name          = '手冊名稱';
$lang->book->summary       = '手冊簡介';
$lang->book->code          = '編碼';
$lang->book->directory     = '目錄管理';
$lang->book->articleList   = '文章管理';
$lang->book->createArticle = '發佈文章';

/* Over write category translations of other module. */
$lang->article->category = '目錄';
$lang->tree->manage      = '維護目錄';
