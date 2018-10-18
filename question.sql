DROP TABLE IF EXISTS `benefit_question`;
DROP TABLE IF EXISTS `benefit_userinfo`;


CREATE TABLE IF NOT EXISTS `benefit_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `telphone` varchar(25) NOT NULL,
  `address` varchar(255) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sessionid` (`sessionid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `benefit_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` varchar(30) NOT NULL,
  `q1` varchar(28) DEFAULT NULL COMMENT '当前年龄？A:"23岁以下",B:"23-30岁&nbsp;&nbsp;",C:"30-40岁&nbsp;&nbsp;",D:"40岁以上"',
  `q2` varchar(28) DEFAULT NULL COMMENT '平时是否化妆？A:"基本每天都化",B:"每周2-4次",C:"有特别需要才化妆，每月不超过5次",D:"基本不化妆"',
  `q3` varchar(28) DEFAULT NULL COMMENT '每月的化妆品消费额度？A:"100以下",B:"100-500",C:"500以上"',
  `q4` varchar(28) DEFAULT NULL COMMENT '怎样定义自己的化妆水平？A:"没有经验",B:"初学者",C:"中级水平",D:"专业级达人"',
  `q5` varchar(28) DEFAULT NULL COMMENT '偏好哪类的妆容？A:"清新自然",B:"性感魅惑",C:"优雅成熟",D:"俏皮可爱",E:"新奇好玩"',
  `q6` varchar(28) DEFAULT NULL COMMENT '近6个月是否购买过粉底类产品？A:"粉底液",B:"粉饼",C:"粉底霜",D:"BB霜",E:"遮瑕棒"',
  `q7` varchar(28) DEFAULT NULL COMMENT '使用粉底类产品的频率是？A:"基本每天都化",B:"每周2-4次",C:"有特别需要才化妆，每月不超过5次",D:"基本不化妆"',
  `q8` varchar(28) DEFAULT NULL COMMENT '经常使用的粉底产品是？A:"粉底液",B:"粉饼",C:"粉底霜",D:"BB霜",E:"遮瑕棒"',
  `q9` varchar(28) DEFAULT NULL COMMENT '经常使用的粉底产品品牌是？A:"贝玲妃",B:"迪 奥",C:"雅诗兰黛",D:"兰蔻",E:"香奈儿",F:"乔治·阿玛尼",G:"其 他"',
  `q10` varchar(28) DEFAULT NULL COMMENT '请选出粉底类产品会考虑的因数？A:"价 格",B:"包 装",C:"品 牌",D:"功 效"',
  `q11` varchar(28) DEFAULT NULL COMMENT '那些产品功效是选购低粉类产品的考虑因数？A:"遮瑕力",B:"粉 质",C:"色 号",D:"持妆力",E:"保湿度",F:"含护肤成分",G:"控 油",H:"光泽度",I:"轻薄度",J:"防晒指数"',
  `q12` varchar(28) DEFAULT NULL COMMENT '购买遮瑕能力中低等的粉底液，你最看重的因素是？12-1 A:"遮瑕力强",B:"持久度高",C:"无妆感",D:"控 油",E:"轻 薄",F:"自 然",G:"保湿度高"',
  `q13` varchar(28) DEFAULT NULL COMMENT '购买遮瑕能力中等的粉底液，你最看重的因素是？12-2 A:"遮瑕力强",B:"控 油",C:"持久度高",D:"易推开",E:"轻 薄",F:"妆感自然",G:"保湿度高",H:"防晒指数高"',
  `q14` varchar(28) DEFAULT NULL COMMENT '购买遮瑕能力中等的粉饼，你最看重的因素是？12-3 A:"遮瑕力强",B:"妆感自然",C:"不干燥",D:"不浮粉",E:"持久度强"',
  `q15` varchar(28) DEFAULT NULL COMMENT '购买遮瑕能力高的粉底膏棒，你最看重的因素是？(12-4 A:"遮瑕力强",B:"易推开",C:"持久度高",D:"妆感自然",E:"不干燥",F:"不浮粉"',
  `q16` varchar(28) DEFAULT NULL COMMENT '是否购买过贝玲妃粉底类产品？A:"有",B:"没有"',
  `q17` varchar(28) DEFAULT NULL COMMENT '是否重复购买过同一件贝玲妃粉底类产品？A:"唱片粉底霜",B:"无瑕疵粉饼",C:"易举多得调色霜",D:"贝玲妃粉底液",E:"贝玲妃粉底遮瑕膏",F:"没 有"',
  `q18` varchar(28) DEFAULT NULL COMMENT '贝玲妃粉底类产品最吸引你的是？A:"价 格",B:"包 装",C:"品 牌",D:"功 效"',
  `q19` varchar(28) DEFAULT NULL COMMENT '贝玲妃粉底类产品功效最吸引你的是？A:"遮瑕力",B:"粉 质",C:"色 号",D:"持妆力",E:"保湿度",F:"含护肤成分",G:"控 油",H:"光泽度",I:"轻薄度",J:"防晒指数"',
  `q20` varchar(28) DEFAULT NULL COMMENT '建议贝玲妃粉底类产品需要改进的方面？A:"价 格",B:"包 装",C:"品 牌",D:"功 效"',
  `q21` varchar(28) DEFAULT NULL COMMENT '建议贝玲妃粉底类产品需要改进的方面？A:"遮瑕力",B:"粉 质",C:"色 号",D:"持妆力",E:"保湿度",F:"含护肤成分",G:"控 油",H:"光泽度",I:"轻薄度",J:"防晒指数"',
  `submittime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sessionid` (`sessionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
