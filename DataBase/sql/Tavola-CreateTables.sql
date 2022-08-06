/*==============================================================*/
/* Index: ADMIN                                                 */
/*==============================================================*/

CREATE TABLE `admin` (
  `adminid` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`adminid`)
);


/*==============================================================*/
/* Index: CATEGORY                                              */
/*==============================================================*/

CREATE TABLE `category` (
  `cat_id` int unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  `cat_photo` varchar(150) NOT NULL,
  PRIMARY KEY (`cat_id`)
);


/*==============================================================*/
/* Index: EXTRA                                                 */
/*==============================================================*/

CREATE TABLE `extra` (
  `id_extra` int unsigned  NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` float  NOT NULL,
  PRIMARY KEY (`id_extra`)
) ;


/*==============================================================*/
/* Index: HAVE                                                  */
/*==============================================================*/

CREATE TABLE `have` (
  `id_extra` int unsigned NOT NULL,
  `cat_id` int unsigned NOT NULL,
  PRIMARY KEY (`id_extra`,`cat_id`),
   FOREIGN KEY (cat_id) REFERENCES category(cat_id),
   FOREIGN KEY (id_extra) REFERENCES extra(id_extra)
);


/*==============================================================*/
/* Index: OFFER                                                 */
/*==============================================================*/
CREATE TABLE `offer` (
  `offer_id` int unsigned NOT NULL AUTO_INCREMENT,
  `discount` int unsigned NOT NULL,
  PRIMARY KEY (`offer_id`)
) ;


/*==============================================================*/
/* Index: CUSTOMER                                              */
/*==============================================================*/

CREATE TABLE `customer` (
  `cid` int unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) NOT NULL,
  `ctel` int unsigned NOT NULL,
  `cemail` varchar(150) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`cid`)
);


/*==============================================================*/
/* Index: DISCOUNT                                              */
/*==============================================================*/

CREATE TABLE `discount` (
  `dis_id` int unsigned NOT NULL AUTO_INCREMENT,
  `pourcentage` int unsigned NOT NULL,
  `unicode` varchar(50) NOT NULL,
  PRIMARY KEY (`dis_id`)
);


/*==============================================================*/
/* Index: FEEDBACK                                              */
/*==============================================================*/

CREATE TABLE `feedback` (
  `id_comm` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `commentaire` varchar(1024) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_comm`)
);


/*==============================================================*/
/* Index: RATING                                                */
/*==============================================================*/

CREATE TABLE `rating` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nb1` int UNSIGNED DEFAULT '0',
  `nb2` int UNSIGNED DEFAULT '0',
  `nb3` int UNSIGNED DEFAULT '0',
  `nb4` int UNSIGNED DEFAULT '0',
  `nb5` int UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ;


/*==============================================================*/
/* Index: ITEM                                                  */
/*==============================================================*/

CREATE TABLE `item` (
  `pid` int unsigned NOT NULL AUTO_INCREMENT,
  `pname` varchar(50) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `price` float  NOT NULL,
  `rat_id` int unsigned NOT NULL,
  `cat_id` int unsigned NOT NULL,
  `offer_id` int unsigned  DEFAULT NULL,
  PRIMARY KEY (`pid`),
  FOREIGN KEY (cat_id) REFERENCES category(cat_id),
  FOREIGN KEY (rat_id) REFERENCES rating(id),
  FOREIGN KEY (offer_id) REFERENCES offer(offer_id)
);


/*==============================================================*/
/* Index: ORDER_INFO                                            */
/*==============================================================*/

CREATE TABLE `order_info` (
  `oid` int unsigned NOT NULL AUTO_INCREMENT,
  `oaddress` varchar(1024) NOT NULL,
  `odate` date NOT NULL,
  `total` float DEFAULT '0',
  `dis_id` int unsigned DEFAULT NULL,
  `cid` int unsigned NOT NULL,
  PRIMARY KEY (`oid`),
  FOREIGN KEY (dis_id) REFERENCES discount(dis_id),
  FOREIGN KEY (cid) REFERENCES customer(cid)
);


/*==============================================================*/
/* Index: CONTAIN                                               */
/*==============================================================*/

CREATE TABLE `contain` (
  `oid` int unsigned NOT NULL,
  `pid` int unsigned NOT NULL,
  `extra_id` int  unsigned,
  `quantity` int unsigned NOT NULL,
  PRIMARY KEY (`oid`,`pid`,`extra_id`),
  FOREIGN KEY (oid) REFERENCES order_info(oid),
  FOREIGN KEY (pid) REFERENCES item(pid),
   FOREIGN KEY (extra_id) REFERENCES extra(id_extra)
);


/*==============================================================*/
/* Index: CURRENCY                                              */
/*==============================================================*/

CREATE TABLE `currency` (
  `name` varchar(10) NOT NULL,
  `symbole` varchar(10) NOT NULL,
  `equal` float  NOT NULL,
  PRIMARY KEY (`name`)
) ;


/*==============================================================*/
/* Index: PHOTO                                                 */
/*==============================================================*/

CREATE TABLE `photo` (
  `id_photo` int unsigned NOT NULL AUTO_INCREMENT,
  `photo_path` varchar(150) NOT NULL,
  `pid` int unsigned NOT NULL,
  PRIMARY KEY (`id_photo`),
  FOREIGN KEY (pid) REFERENCES item(pid)
);



/*==============================================================*/
/* Index: RESERVATION                                           */
/*==============================================================*/


CREATE TABLE  `reservation` (
  `Rid` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `guestnb` int NOT NULL,
  `Rdate` date NOT NULL,
  `time` int UNSIGNED NOT NULL,
  PRIMARY KEY (`Rid`)
); 


/*==============================================================*/
/* Index: RESTAURANT_INFO                                       */
/*==============================================================*/


CREATE TABLE `restaurant_info`(
 `Tid` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `tablenb` int UNSIGNED NOT NULL ,
   `chairnb` int UNSIGNED NOT NULL ,
    PRIMARY KEY (`Tid`) 
);