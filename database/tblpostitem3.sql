/* CREATE TABLE IF NOT EXISTS `tblpostitem` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `overview` longtext,
  `usedYear` int(4) NOT NULL,
  `pricePerDay` int(12) NOT NULL,
  `totalPrice` int(12) NOT NULL,
  `payPalBusinessAccount` varchar(100) NOT NULL,
  `contactNo` int(15) NOT NULL,
  `image` varchar(120) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delmode` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; */

DROP TABLE tblpostitem;

CREATE TABLE IF NOT EXISTS `tblpostitem` (
  
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(100),
  `usedYear` int(4),
  `overview` longtext,
  `totalPrice` int(12),
  `pricePerDay` int(12),
  `value` int(12),
  `payPalBusinessAccount` varchar(100),
  `contactNo` varchar(120),
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `sell` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `swap` int(11) DEFAULT NULL,
  `updationDate` timestamp DEFAULT CURRENT_TIMESTAMP,
  `delmode` varchar(100),
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/* CREATE TABLE IF NOT EXISTS `tblpostitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(100),
  `overview` longtext,
  `usedYear` int(4),
  `pricePerDay` int(12),
  `totalPrice` int(12),
  `payPalBusinessAccount` varchar(100),
  `contactNo` int(15),
  `image` varchar(120) NOT NULL,
  `sell` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `swap` int(11) DEFAULT NULL,
  `updationDate` timestamp DEFAULT CURRENT_TIMESTAMP,
  `delmode` varchar(100),
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; */

/* CREATE TABLE IF NOT EXISTS `tblpostitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(100),
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; */

-- 

INSERT INTO tblpostitem
(name,overview,usedYear,pricePerDay,totalPrice,payPalBusinessAccount,contactNo,image) 
VALUES
(":name",":overview",1,1,1,"payPalBusinessAccount@gmail.com",123456,":image")

INSERT INTO tblpostitem
(name,overview,usedYear,pricePerDay,totalPrice,payPalBusinessAccount,contactNo,image) 
VALUES
("a","a",1,1,1,"a@gmail.com",1,"a")

-- 

$productName . $overview . $usedYear . $pricePerDay . $totalPrice . $payPalBusinessAccount . $contactNo . $image

"w",2,2,"w","w"

-- 

sell
rent
swap

sell,rent,swap

-- 

  `productName` varchar(100),
  `usedYear` int(4),
  
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,

  `sell` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `swap` int(11) DEFAULT NULL,

  `overview` longtext,
  `pricePerDay` int(12),
  `totalPrice` int(12),

  `updationDate` timestamp DEFAULT CURRENT_TIMESTAMP,
  