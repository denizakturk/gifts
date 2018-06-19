<?php

echo "\nBEGIN CREATE DATABSE\n";

$con = mysqli_connect("localhost", "root", "vagrant");

mysqli_query($con, "CREATE DATABASE gifts");

mysqli_query($con, "USE gifts");
echo "\nCREATED DATABSE\n";
mysqli_query(
    $con,
    "CREATE TABLE `gift` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL DEFAULT '',
  `slug` varchar(127) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;"
);

mysqli_query(
    $con,
    "CREATE TABLE `gift_sent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `gift_id` int(11) unsigned NOT NULL,
  `recipient_id` int(11) unsigned NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;"
);

mysqli_query(
    $con,
    "CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;"
);

echo "\nCREATED TABLES\n";

mysqli_query($con, "INSERT INTO `user` (`id`, `name`, `surname`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted`)
VALUES
	(1, 'jhon', 'moon', 'jhon.moon', 'jhon.moon@gifts.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-06-14 20:35:10', NULL, NULL),
	(2, 'jessy', 'moon', 'jessy.moon', 'jessy.moon@gifts.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-06-14 20:35:10', NULL, NULL),
	(3, 'jimmy', 'moon', 'jimmy.moon', 'jimmy.moon@gifts.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-06-14 20:35:10', NULL, NULL),
	(4, 'jully', 'moon', 'jully.moon', 'jully.moon@gifts.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-06-14 20:35:10', NULL, NULL);
");

mysqli_query($con, "INSERT INTO `gift` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted`)
VALUES
	(1, 'Heart', 'heart', '2018-06-17 19:35:29', NULL, NULL),
	(2, 'Shoe', 'shoe', '2018-06-17 19:35:54', NULL, NULL),
	(3, 'Hat', 'hat', '2018-06-17 19:36:13', NULL, NULL),
	(4, 'Gold', 'gold', '2018-06-17 19:37:59', NULL, NULL);
");

echo "\nINSERTED DATA\n";

echo "\nEND\n";