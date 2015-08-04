CREATE TABLE `vote_options_record` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`option_id` int(11) NOT NULL DEFAULT '0' COMMENT '选项id',
	`user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
	`status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  	`create_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  	`modify_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '数据发生修改的时间',
  	PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT '选项记录表';