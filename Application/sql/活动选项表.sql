CREATE TABLE `vote_activity_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL DEFAULT '0' COMMENT '活动id',
  `options_content` varchar(255) NOT NULL DEFAULT '' COMMENT '选项内容',
  `create_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `modify_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '数据发生修改的时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `options_order` int(2) NOT NULL DEFAULT '0' COMMENT '选项序号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='活动人员表';