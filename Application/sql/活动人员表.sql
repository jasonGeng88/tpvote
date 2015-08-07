CREATE TABLE `vote_activity_user` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`activity_id` int(11) NOT NULL DEFAULT '0' COMMENT '活动id',
	`user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  	`create_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  	`modify_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '数据发生修改的时间',
  	PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT '活动人员表';