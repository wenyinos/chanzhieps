-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`) VALUES
("block1", 'latestArticle', 'Latest Article', '{"category":"0","limit":"7"}', 'default'),
("block2", 'hotArticle', 'Hot Article', '{"category":"0","limit":"7"}', 'default'),
("block3", 'latestProduct', 'Latest Product', '{"category":"0","limit":"3","image":"show"}', 'default'),
("block4", 'hotProduct', 'Hot Product', '{"category":"0","limit":"3","image":"show"}', 'default'),
("block5", 'slide', 'Slide', '', 'default'),
("block6", 'articleTree', 'Article Category', '{"showChildren":"0"}', 'default'),
("block7", 'productTree', 'Product Category', '{"showChildren":"0"}', 'default'),
("block8", 'blogTree', 'Blog Category', '{"showChildren":"1"}', 'default'),
("block9", 'contact', 'Contact Us', '', 'default'),
("block10", 'about', 'About Us', '', 'default'),
("block11", 'links', 'Link', '', 'default'),
("block12", 'header', 'Header', '', 'default'),
("block13", 'followUs', 'Follow Us', '', 'default');

INSERT INTO `eps_layout` (`page`, `region`, `blocks`, `template`,`lang`) VALUES
('all', 'top', '[{"id":"block12","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'top', '[{"id":"block5","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'middle', '[{"id":"block3","grid":12,"titleless":0,"borderless":0},{"id":"block10","grid":4,"titleless":0,"borderless":0},{"id":"block1","grid":4,"titleless":0,"borderless":0},{"id":"block9","grid":4,"titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'bottom', '[{"id":"block11","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('company_index', 'side', '[{"id":"block9","grid":"","titleless":0,"borderless":0},{"id":"block13","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('article_browse', 'side', '[{"id":"block6","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('article_view', 'side', '[{"id":"block6","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('product_browse', 'side', '[{"id":"block4","grid":"","titleless":0,"borderless":0},{"id":"block7","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('product_view', 'side', '[{"id":"block4","grid":"","titleless":0,"borderless":0},{"id":"block7","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('message_index', 'side', '[{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('blog_index', 'side', '[{"id":"block8","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('blog_view', 'side', '[{"id":"block8","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('page_index', 'side', '[{"id":"block2","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('page_view', 'side', '[{"id":"block2","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn');
