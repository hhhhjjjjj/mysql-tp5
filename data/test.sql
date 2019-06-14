/*
Navicat MySQL Data Transfer

Source Server         : 本地连接
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-05-07 21:21:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for addketi
-- ----------------------------
DROP TABLE IF EXISTS `addketi`;
CREATE TABLE `addketi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gonghao` int(10) NOT NULL,
  `keti_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `teacher` varchar(50) CHARACTER SET utf8 NOT NULL,
  `state` int(10) NOT NULL,
  `origin` varchar(15) CHARACTER SET utf8 NOT NULL,
  `detail` varchar(500) CHARACTER SET utf8 NOT NULL,
  `jiaoyan` varchar(50) CHARACTER SET utf8 NOT NULL,
  `user_xuehao` int(15) NOT NULL,
  `timer` int(15) NOT NULL,
  `advice` varchar(500) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of addketi
-- ----------------------------
INSERT INTO `addketi` VALUES ('11', '100001001', '图书管理系统', '李大辉', '0', '指导教师拟定', '用户浏览书籍、借书等操作', '系统分析师', '151164403', '1553042571', '');
INSERT INTO `addketi` VALUES ('12', '100001001', '手机APP开发-导航系统', '李大辉', '0', '指导教师拟定', '   手机app开发 定制开发app,原生开发,项目经验丰富,团队实力雄厚!提供一站式策划,设计,研发app.拒绝功能拼凑,模板套用,每个app量身定制开发.', '系统分析师', '151164407', '1553042571', '');
INSERT INTO `addketi` VALUES ('18', '100001001', '555', '李大辉', '0', '指导教师拟定', '5555', '系统分析师', '151164409', '1553347574', '');
INSERT INTO `addketi` VALUES ('20', '100001001', '宿舍s', '李大辉', '1', '指导教师拟定', '是是是', '系统分析师', '151164410', '1554462040', '');
INSERT INTO `addketi` VALUES ('22', '100001004', '基于reactnative的教育平台系统', '刘文星', '1', '学生建议', '使用此app可以实现查看个人信息，查看教育视频等功能', '系统分析师', '151164411', '1554987246', '11111111111');
INSERT INTO `addketi` VALUES ('23', '100001003', '网络购物网站的设计与实现', '潘力', '1', '指导教师拟定', '实现网上购物与管理员后台管理', '动漫技术教研室', '151164412', '1555324453', '审核课题通过');
INSERT INTO `addketi` VALUES ('24', '100001002', '基于ios的教学平台开发', '祝孔涛', '1', '学生建议', '基于ios的教学平台开发，手机端开发', '动漫技术教研室', '151164413', '1555555038', '课题审核通过 ');
INSERT INTO `addketi` VALUES ('25', '100001002', '基于PHP的毕业设计管', '祝孔涛', '1', '学生建议', '毕业设计管理系统', '动漫技术教研室', '151164414', '1555573584', 'to');
INSERT INTO `addketi` VALUES ('26', '100001001', '基于php的家具购买商城', '李大辉', '2', '学生建议', '基于php的家具购买商城', '系统分析师', '151164415', '1555664670', '审核不通过');

-- ----------------------------
-- Table structure for admin_list
-- ----------------------------
DROP TABLE IF EXISTS `admin_list`;
CREATE TABLE `admin_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admintor_num` int(11) NOT NULL,
  `psd` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_list
-- ----------------------------
INSERT INTO `admin_list` VALUES ('1', '121111101', '50015f171ca3a9c0a3529dd381e3f217', '张三', '0');
INSERT INTO `admin_list` VALUES ('2', '121111102', '50015f171ca3a9c0a3529dd381e3f217', '李四', '0');
INSERT INTO `admin_list` VALUES ('3', '121111103', '50015f171ca3a9c0a3529dd381e3f217', '王五', '0');

-- ----------------------------
-- Table structure for check_list
-- ----------------------------
DROP TABLE IF EXISTS `check_list`;
CREATE TABLE `check_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `wancheng` varchar(500) CHARACTER SET utf8 NOT NULL,
  `weicheng` varchar(500) CHARACTER SET utf8 NOT NULL,
  `timer` int(50) NOT NULL,
  `file_path` varchar(50) CHARACTER SET utf8 NOT NULL,
  `state` int(10) NOT NULL,
  `xuehao` int(15) NOT NULL,
  `gonghao` int(15) NOT NULL,
  `pingjia` varchar(500) CHARACTER SET utf8 NOT NULL,
  `file_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `file_size` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of check_list
-- ----------------------------
INSERT INTO `check_list` VALUES ('7', 'xxxxxxxxxxxx', 'eeeeeeeee', '1554479127', '', '1', '151164410', '100001001', '中期检查审核通过', '', '');
INSERT INTO `check_list` VALUES ('8', '11111111111', '222222222', '1555080324', '20190412a61651bf5bd6bc90839983694afabea3.doc', '1', '151164411', '100001004', '中期检查审核通过', '基于Android技术的科技社交圈子系统开发.doc', '1917k');
INSERT INTO `check_list` VALUES ('9', '用户登录、网上购物、加入购物车等前台页面', '后台管理、添加商品等功能', '1555334859', '20190415ed6ae2eb53c65b549e13fd5698285acd.doc', '1', '151164412', '100001003', '中期检查通过', '中期检查表黄晶.doc', '19k');
INSERT INTO `check_list` VALUES ('10', '用户登录，完成课程学习', '管理员管理后台', '1555555855', '20190418\08ca3b14b0438c9f256c83e959a7be44.doc', '1', '151164413', '100001002', '中期检查审核通过', '中期检查表黄晶.doc', '19k');

-- ----------------------------
-- Table structure for dabian_list
-- ----------------------------
DROP TABLE IF EXISTS `dabian_list`;
CREATE TABLE `dabian_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `liyou` varchar(500) CHARACTER SET utf8 NOT NULL,
  `timer` int(15) NOT NULL,
  `xuehao` int(15) NOT NULL,
  `dabian_time` varchar(50) CHARACTER SET utf8 NOT NULL,
  `state` int(15) NOT NULL,
  `gonghao` int(15) NOT NULL,
  `pingjia` varchar(500) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dabian_list
-- ----------------------------
INSERT INTO `dabian_list` VALUES ('5', '功能完善，请求答辩', '1555336101', '151164412', '2019年5月12号', '1', '100001003', '答辩申请通过');
INSERT INTO `dabian_list` VALUES ('3', '1111111111111', '1554481201', '151164410', '2019年5月2号', '1', '100001001', '答辩申请通过');
INSERT INTO `dabian_list` VALUES ('4', '答辩申请', '1555148426', '151164411', '2019年5月10号', '1', '100001004', '答辩申请通过');
INSERT INTO `dabian_list` VALUES ('6', '请求完成答辩', '1555556134', '151164413', '2019年5月15日', '1', '100001002', '答辩申请通过');

-- ----------------------------
-- Table structure for gonggao_list
-- ----------------------------
DROP TABLE IF EXISTS `gonggao_list`;
CREATE TABLE `gonggao_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_num` int(20) NOT NULL,
  `content` text NOT NULL,
  `timer` int(32) NOT NULL,
  `title` varchar(200) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gonggao_list
-- ----------------------------
INSERT INTO `gonggao_list` VALUES ('1', '121111101', '评审委员会\"已审阅的毕业论文已下发（部分仍在审阅中），相关事宜如下：1、“审核意见”在档案袋内（见论文封皮111', '1555158568', '评审委员会222', '张三');
INSERT INTO `gonggao_list` VALUES ('2', '121111101', '全体师生：经软件学院学位评定委员会研究决定，现将整个毕业设计（论文）流程中涉及的时间节点统一规范（', '1542542953', '关于毕业设计（论文）时间节点的说明', '张三');
INSERT INTO `gonggao_list` VALUES ('3', '121111101', '2019届本科毕业生：经软件学院学位评定委员会会议研究决定，现将“现将二次答辩”事宜通知如下：一、二次答辩于5', '1542542953', '软件学院关于2019届本科毕业生“二次答辩”', '张三');
INSERT INTO `gonggao_list` VALUES ('4', '121111101', '答辩合格同学：经软件学院学位评定委员会会议研究决定，现将毕业设计（论文）材料审核、整理、装订事宜', '1542542953', '软件学院关于毕业设计（论文）材料审核', '张三');
INSERT INTO `gonggao_list` VALUES ('5', '121111101', '各位同学：如下：一、论文模板修订版（版本3.3）见附件。二、将新的论文模板更名为“XXX毕业论文（新）', '1542542953', '第二次论文模板更新说明', '张三');

-- ----------------------------
-- Table structure for kaiti_list
-- ----------------------------
DROP TABLE IF EXISTS `kaiti_list`;
CREATE TABLE `kaiti_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `xuehao` int(15) NOT NULL,
  `yiyi` varchar(500) CHARACTER SET utf8 NOT NULL,
  `jiegou` varchar(500) CHARACTER SET utf8 NOT NULL,
  `fangfa` varchar(500) CHARACTER SET utf8 NOT NULL,
  `timer` int(50) NOT NULL,
  `file_path` varchar(50) CHARACTER SET utf8 NOT NULL,
  `state` int(10) NOT NULL,
  `gonghao` int(15) NOT NULL,
  `pingjia` varchar(500) CHARACTER SET utf8 NOT NULL,
  `file_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `file_size` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kaiti_list
-- ----------------------------
INSERT INTO `kaiti_list` VALUES ('8', '151164412', '方便用户网络购物', '网上购物', '用户网上购物管理员后台管理', '1555334383', '20190415e7218a7c2d66e249ffc71c1d957ae20c.docx', '1', '100001003', '开题报告审核通过', '开题报告（151164411黄晶）.docx', '24k');
INSERT INTO `kaiti_list` VALUES ('6', '151164410', 'aaaaaaaaaaaaa', 'bbbbbbbbbbbbb', 'ccccccccccccc', '1554476261', '', '1', '100001001', '开题报告审核通过', '', '');
INSERT INTO `kaiti_list` VALUES ('7', '151164411', '1111111111111', '22222222222', '333333333333', '1555078122', '20190412fba8cc01e924cafc48e39f0fc6c33ec0.docx', '1', '100001004', '开题报告审核通过', '开题报告（151164411黄晶）.docx', '24k');
INSERT INTO `kaiti_list` VALUES ('9', '151164413', '基于ios的教育平台，方便用户利用业余时间学习。', '手机端开发', 'ios，手机端', '1555555674', '20190418\00569155055601eb168ea05dd10a0884.docx', '1', '100001002', '开题报告审核通过', '开题报告（151164411黄晶）.docx', '23k');

-- ----------------------------
-- Table structure for keti_list
-- ----------------------------
DROP TABLE IF EXISTS `keti_list`;
CREATE TABLE `keti_list` (
  `gonghao` int(5) NOT NULL,
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `keti_name` varchar(100) NOT NULL,
  `origin` varchar(14) NOT NULL,
  `teacher` varchar(20) NOT NULL,
  `jiaoyan` varchar(8) NOT NULL,
  `xuehao` int(15) NOT NULL,
  `detail` varchar(500) NOT NULL,
  `state` tinyint(2) NOT NULL,
  `ketiS_state` int(2) NOT NULL,
  `dabianS_state` int(2) NOT NULL,
  `checkS_state` int(2) NOT NULL,
  `renwuS_state` int(2) NOT NULL,
  `kaitiS_state` int(2) NOT NULL,
  `shejiS_state` int(2) NOT NULL,
  `timer` int(15) NOT NULL,
  `luru_state` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keti_list
-- ----------------------------
INSERT INTO `keti_list` VALUES ('100001003', '2', '网络购物网站的设计与实现', '指导教师拟定', '潘力', '动漫技术教研室', '151164412', '实现网上购物与管理员后台管理', '1', '1', '1', '1', '1', '1', '1', '1555332716', '1');
INSERT INTO `keti_list` VALUES ('100001003', '3', '少儿教育网站的设计与实现', '指导教师拟定', '潘力', '动漫技术教研室', '0', '针对少儿教育设计的网站实现网上学习管理员功能等', '0', '0', '0', '0', '0', '0', '0', '1553042571', '0');
INSERT INTO `keti_list` VALUES ('100001003', '4', '影楼管理系统网站设计与实现', '指导教师拟定', '潘力', '动漫技术教研室', '0', '普通用户登录系统浏览、预定摄影师等管理员后台管理', '0', '0', '0', '0', '0', '0', '0', '1553042571', '0');
INSERT INTO `keti_list` VALUES ('100001002', '5', '二维动画短片创作', '指导教师拟定', '祝孔涛', '动漫技术教研室', '0', '设计实现短片动画', '0', '0', '0', '0', '0', '0', '0', '1553042571', '0');
INSERT INTO `keti_list` VALUES ('100001004', '10', '贪吃蛇游戏', '指导教师拟定', '刘文星', '系统分析师', '0', '   1111111111111', '0', '0', '0', '0', '0', '0', '0', '1553042571', '0');
INSERT INTO `keti_list` VALUES ('100001001', '8', '图书管理系统', '指导教师拟定', '李大辉', '系统分析师', '151164403', '用户浏览书籍、借书等操作', '1', '0', '0', '0', '0', '0', '0', '1553042571', '0');
INSERT INTO `keti_list` VALUES ('100001001', '11', '手机APP开发-导航系统', '指导教师拟定', '李大辉', '系统分析师', '151164407', '   手机app开发 定制开发app,原生开发,项目经验丰富,团队实力雄厚!提供一站式策划,设计,研发app.拒绝功能拼凑,模板套用,每个app量身定制开发.', '1', '0', '0', '0', '0', '0', '0', '1553042571', '0');
INSERT INTO `keti_list` VALUES ('100001001', '13', '宿舍s', '指导教师拟定', '李大辉', '系统分析师', '151164410', '是是是', '1', '1', '1', '1', '1', '1', '1', '1553042571', '1');
INSERT INTO `keti_list` VALUES ('100001001', '18', '555', '指导教师拟定', '李大辉', '系统分析师', '151164409', '5555', '1', '0', '0', '0', '0', '0', '0', '1553042571', '0');
INSERT INTO `keti_list` VALUES ('100001004', '23', '基于reactnative的教育平台系统', '学生建议', '刘文星', '系统分析师', '151164411', '使用此app可以实现查看个人信息，查看教育视频等功能', '1', '1', '1', '1', '1', '1', '1', '1554987246', '1');
INSERT INTO `keti_list` VALUES ('100001002', '26', '基于ios的教学平台开发', '学生建议', '祝孔涛', '动漫技术教研室', '151164413', '基于ios的教学平台开发，手机端开发', '1', '1', '1', '1', '1', '1', '1', '1555555148', '1');
INSERT INTO `keti_list` VALUES ('100001002', '27', '基于PHP的毕业设计管', '学生建议', '祝孔涛', '动漫技术教研室', '151164414', '毕业设计管理系统', '1', '1', '0', '0', '1', '0', '0', '1555573742', '0');

-- ----------------------------
-- Table structure for renwu_list
-- ----------------------------
DROP TABLE IF EXISTS `renwu_list`;
CREATE TABLE `renwu_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `xuehao` int(15) NOT NULL,
  `content` varchar(500) CHARACTER SET utf8 NOT NULL,
  `wenxian` varchar(500) CHARACTER SET utf8 NOT NULL,
  `jihua` varchar(500) CHARACTER SET utf8 NOT NULL,
  `file_path` varchar(100) CHARACTER SET utf8 NOT NULL,
  `state` int(10) NOT NULL,
  `timer` int(15) NOT NULL,
  `gonghao` int(15) NOT NULL,
  `pingjia` varchar(500) CHARACTER SET utf8 NOT NULL,
  `file_name` varchar(500) CHARACTER SET utf8 NOT NULL,
  `file_size` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of renwu_list
-- ----------------------------
INSERT INTO `renwu_list` VALUES ('9', '151164412', '网络购物', '《网络购物》', '6个月内完成', '2019041595b58014a9aaac7c7306a9c278312d36.docx', '1', '1555333190', '100001003', '任务书审核通过', '任务书.docx', '10k');
INSERT INTO `renwu_list` VALUES ('5', '151164410', '1111111111111111111', '222222222222222222', '333333333333333333', '', '1', '1554473293', '100001001', '任务书审核通过', '', '');
INSERT INTO `renwu_list` VALUES ('8', '151164411', '1111111', '222222222222', '333333333', '20190412aeff965ef3f9504e3ad5fed5caf44df9.zip', '1', '1555073875', '100001004', '任务书审核通过', '系统验收分组说明.zip', '66k');
INSERT INTO `renwu_list` VALUES ('10', '151164413', '基于ios的教育平台开发，手机端用户。', 'ios开发指南', '6个月内完成', '2019041875eb3c82d7d05f8c4d7bca6ed736b537.docx', '1', '1555555400', '100001002', '任务书审核通过', '任务书.docx', '10k');
INSERT INTO `renwu_list` VALUES ('11', '151164414', '1111', '11111', '1111', '20190418ea3d1ffb16d6ac49d31927e0dd5d6354.docx', '1', '1555573799', '100001002', 'success', '任务书.docx', '10k');

-- ----------------------------
-- Table structure for score_list
-- ----------------------------
DROP TABLE IF EXISTS `score_list`;
CREATE TABLE `score_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `zhidao_score` varchar(50) CHARACTER SET utf8 NOT NULL,
  `dabian_score` varchar(50) CHARACTER SET utf8 NOT NULL,
  `xuehao` int(10) NOT NULL,
  `gonghao_zhidao` int(10) NOT NULL,
  `gonghao_dabian` int(10) NOT NULL,
  `zhidao_time` int(50) NOT NULL,
  `dabian_time` int(50) NOT NULL,
  `zhidao_pingjia` varchar(500) CHARACTER SET utf8mb4 NOT NULL,
  `zhidaoT_state` int(2) NOT NULL,
  `dabianT_state` int(2) NOT NULL,
  `dabian_pingjia` varchar(500) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of score_list
-- ----------------------------
INSERT INTO `score_list` VALUES ('12', '100', '100', '151164410', '100001001', '121111101', '1554632141', '1555160716', '录入成绩成功', '1', '1', '录入答辩成绩成功');
INSERT INTO `score_list` VALUES ('13', '100', '', '151164411', '100001004', '121111101', '1555148313', '0', '', '1', '0', '');
INSERT INTO `score_list` VALUES ('14', '100', '100', '151164412', '100001003', '121111101', '1555336349', '1555336721', '文档提交完整', '1', '1', '录入答辩成绩成功');
INSERT INTO `score_list` VALUES ('15', '100', '100', '151164413', '100001002', '121111101', '1555556231', '1555556459', '录入指导成绩成功', '1', '1', '录入答辩成绩成功');

-- ----------------------------
-- Table structure for sheji_list
-- ----------------------------
DROP TABLE IF EXISTS `sheji_list`;
CREATE TABLE `sheji_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `xuehao` int(15) NOT NULL,
  `beijing` varchar(500) CHARACTER SET utf8 NOT NULL,
  `fenxi` varchar(500) CHARACTER SET utf8 NOT NULL,
  `zongjie` varchar(500) CHARACTER SET utf8 NOT NULL,
  `state` int(10) NOT NULL,
  `file_path` varchar(50) CHARACTER SET utf8 NOT NULL,
  `timer` int(15) NOT NULL,
  `gonghao` int(15) NOT NULL,
  `pingjia` varchar(500) CHARACTER SET utf8 NOT NULL,
  `file_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `file_size` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sheji_list
-- ----------------------------
INSERT INTO `sheji_list` VALUES ('3', '151164410', 'qqqqqqqqqqq', 'wwwwwwwwwwwww', 'eeeeeeeeeeeee', '1', '', '1554480391', '100001001', '毕业设计审核通过', '', '');
INSERT INTO `sheji_list` VALUES ('4', '151164411', '1111111111111', '22222222222222', '333333333333', '1', '201904125b5838a38608e98146883a1b9b29ffd1.doc', '1555082671', '100001004', '毕业设计审核通过', '中期检查表黄晶.doc', '19k');
INSERT INTO `sheji_list` VALUES ('5', '151164412', '互联网发达', '用户购物界面，后台管理', '网络购物总结', '1', '20190415916b0161a028100922fad54230853e94.doc', '1555335916', '100001003', '毕业设计审核通过', '基于Android技术的科技社交圈子系统开发.doc', '1917k');
INSERT INTO `sheji_list` VALUES ('6', '151164413', '背景：互联网发达', '用户，管理员', '上线', '1', '2019041892ecbce022c8e5083b86ea1583a20500.doc', '1555556010', '100001002', '毕业设计审核通过', '基于Android技术的科技社交圈子系统开发.doc', '1917k');

-- ----------------------------
-- Table structure for teacher_study
-- ----------------------------
DROP TABLE IF EXISTS `teacher_study`;
CREATE TABLE `teacher_study` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `gonghao` int(5) NOT NULL,
  `psd` varchar(50) NOT NULL,
  `name` varchar(5) NOT NULL,
  `jclass` varchar(50) NOT NULL,
  `state` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher_study
-- ----------------------------
INSERT INTO `teacher_study` VALUES ('1', '100001001', '50015f171ca3a9c0a3529dd381e3f217', '李大辉', '系统分析师', '0');
INSERT INTO `teacher_study` VALUES ('2', '100001002', '50015f171ca3a9c0a3529dd381e3f217', '祝孔涛', '动漫技术教研室', '0');
INSERT INTO `teacher_study` VALUES ('3', '100001003', '50015f171ca3a9c0a3529dd381e3f217', '潘力', '动漫技术教研室', '0');
INSERT INTO `teacher_study` VALUES ('4', '100001004', '50015f171ca3a9c0a3529dd381e3f217', '刘文星', '系统分析师', '0');

-- ----------------------------
-- Table structure for user_study
-- ----------------------------
DROP TABLE IF EXISTS `user_study`;
CREATE TABLE `user_study` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `xuehao` int(5) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `state` int(2) NOT NULL,
  `renwu_state` int(2) NOT NULL,
  `dabian_state` int(2) NOT NULL,
  `check_state` int(2) NOT NULL,
  `kaiti_state` int(2) NOT NULL,
  `sheji_state` int(2) NOT NULL,
  `dabian_cho` int(2) NOT NULL,
  `dabian_ren` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_study
-- ----------------------------
INSERT INTO `user_study` VALUES ('1', '151164401', '50015f171ca3a9c0a3529dd381e3f217', '张三三', '软件二班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('2', '151164402', '50015f171ca3a9c0a3529dd381e3f217', '李四', '软件一班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('3', '151164403', '50015f171ca3a9c0a3529dd381e3f217', '王五', '软件一班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('4', '151164404', '50015f171ca3a9c0a3529dd381e3f217', '赵小明', '软件一班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('5', '151164405', '50015f171ca3a9c0a3529dd381e3f217', '徐艺华', '软件一班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('6', '151164406', '50015f171ca3a9c0a3529dd381e3f217', '全高恩', '软件一班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('7', '151164407', '50015f171ca3a9c0a3529dd381e3f217', '黄国华', '软件一班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('9', '151164408', '50015f171ca3a9c0a3529dd381e3f217', 'hhh', '15级嵌入一班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('12', '151164409', '50015f171ca3a9c0a3529dd381e3f217', 'hjhj', '15级嵌入一班', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('15', '151164410', '50015f171ca3a9c0a3529dd381e3f217', 'hhh', '15级嵌入一班', '0', '1', '1', '1', '1', '1', '1', '121111101');
INSERT INTO `user_study` VALUES ('17', '151164411', '50015f171ca3a9c0a3529dd381e3f217', '肖英华', '15级网媒一班', '0', '1', '1', '1', '1', '1', '1', '121111101');
INSERT INTO `user_study` VALUES ('19', '151164413', '50015f171ca3a9c0a3529dd381e3f217', '姜惠元', '15级金融一班', '0', '1', '1', '1', '1', '1', '1', '121111101');
INSERT INTO `user_study` VALUES ('18', '151164412', '50015f171ca3a9c0a3529dd381e3f217', '宫胁咲良', '15级嵌入一班', '0', '1', '1', '1', '1', '1', '1', '121111101');
INSERT INTO `user_study` VALUES ('20', '151164414', '50015f171ca3a9c0a3529dd381e3f217', '赵晓华', '15级嵌入一班', '0', '1', '0', '0', '0', '0', '0', '0');
INSERT INTO `user_study` VALUES ('21', '151164415', '50015f171ca3a9c0a3529dd381e3f217', 'kkk', '15级网媒一班', '0', '0', '0', '0', '0', '0', '0', '0');
