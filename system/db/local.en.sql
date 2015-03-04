-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`) VALUES
(101, 'latestArticle', 'Latest Article', '{"category":"0","limit":"7"}', 'default'),
(102, 'hotArticle', 'Hot Article', '{"category":"0","limit":"7"}', 'default'),
(103, 'latestProduct', 'Latest Product', '{"category":"0","limit":"3","image":"show"}', 'default'),
(104, 'hotProduct', 'Hot Product', '{"category":"0","limit":"3","image":"show"}', 'default'),
(105, 'slide', 'Slide', '', 'default'),
(106, 'articleTree', 'Article Category', '{"showChildren":"0"}', 'default'),
(107, 'productTree', 'Product Category', '{"showChildren":"0"}', 'default'),
(108, 'blogTree', 'Blog Category', '{"showChildren":"1"}', 'default'),
(109, 'contact', 'Contact Us', '', 'default'),
(110, 'about', 'About Us', '', 'default'),
(111, 'links', 'Link', '', 'default'),
(112, 'header', 'Header', '', 'default'),
(113, 'followUs', 'Follow Us', '', 'default');
