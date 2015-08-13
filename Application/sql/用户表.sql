CREATE TABLE `vote_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(25) NOT NULL DEFAULT '' COMMENT '用户名',
  `passwd` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态 0-未激活 1-激活',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '状态 0-用户 1-管理员',
  `create_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `modify_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '数据发生修改的时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户表';
INSERT INTO `vote_user`(`account`,`passwd`,`status`,`type`,`create_datetime`) VALUES("admin","admin",1,1,"2015-08-10 00:00:00");