-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
("block1", 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'mobile','zh-tw'),
("block2", 'latestProduct', '最新產品', '{"category":"0","limit":"3","image":"show"}', 'mobile','zh-tw'),
("block3", 'slide', '幻燈片', '', 'mobile','zh-tw'),
("block4", 'articleTree', '文章分類', '{"showChildren":"0"}', 'mobile','zh-tw'),
("block5", 'productTree', '產品分類', '{"showChildren":"0"}', 'mobile','zh-tw'),
("block6", 'pageList', '單頁列表', '{"limit":"7"}', 'mobile','zh-tw'),
("block7", 'about', '公司簡介', '', 'mobile','zh-tw');

INSERT INTO `eps_layout` (`template`, `theme`, `page`, `region`, `blocks`, `import`, `lang`) VALUES
('mobile','default','index_index','top','[{"id":"block3","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','default','index_index','middle','[{"id":"block7","grid":"0","titleless":"0","borderless":"0"},{"id":"block2","grid":"12","titleless":"0","borderless":"0"},{"id":"block1","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','default','article_browse','top','[{"id":"block4","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','default','article_view','top','[{"id":"block4","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','default','product_browse','top','[{"id":"block5","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','default','product_view','top','[{"id":"block5","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','default','page_view','top','[{"id":"block6","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn');
