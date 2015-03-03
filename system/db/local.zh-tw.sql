-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`) VALUES
(201, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'default'),
(202, 'hotArticle', '熱門文章', '{"category":"0","limit":"7"}', 'default'),
(203, 'latestProduct', '最新產品', '{"category":"0","limit":"3","image":"show"}', 'default'),
(204, 'hotProduct', '熱門產品', '{"category":"0","limit":"3","image":"show"}', 'default'),
(205, 'slide', '幻燈片', '', 'default'),
(206, 'articleTree', '文章分類', '{"showChildren":"0"}', 'default'),
(207, 'productTree', '產品分類', '{"showChildren":"0"}', 'default'),
(208, 'blogTree', '博客分類', '{"showChildren":"1"}', 'default'),
(209, 'contact', '聯繫我們', '', 'default'),
(210, 'about', '公司簡介', '', 'default'),
(211, 'links', '友情鏈接', '', 'default'),
(212, 'header', '網站頭部', '', 'default'),
(213, 'followUs', '關注我們', '', 'default');
