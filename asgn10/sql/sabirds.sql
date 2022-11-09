-- Remove these two lines before running on your webhost
DROP DATABASE IF EXISTS sabird;
CREATE DATABASE sabird;

-- Start here for running SQL on your webhost
-- Make sure to select your database first from 
-- the left-hand side menu choices

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:00";

DROP TABLE IF EXISTS birds;
CREATE TABLE birds (
  id int(11) NOT NULL AUTO_INCREMENT,
  common_name varchar(100) NOT NULL,
  habitat varchar(100) NOT NULL,
  food varchar(100) NOT NULL,
  conservation_id tinyint(4) NOT NULL,
  backyard_tips text NOT NULL,
  PRIMARY KEY (id) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `birds` (`id`, `common_name`, `habitat`, `food`, `conservation_id`, `backyard_tips`) VALUES
(NULL, 'Carolina Wren', 'Open woodlands', 'Insects', 1, 'Carolina Wrens visit suet-filled feeders during winter.'),
(NULL, 'Tufted Titmouse', 'Forests', 'Insects', 1, 'Tufted Titmouse are regulars at backyard bird feeders, especially in winter. They prefer sunflower seeds but will eat suet, peanuts, and other seeds as well.'),
(NULL, 'Ruby-Throated Hummingbird', 'Open woodlands', 'Nectar', 1, 'You can attract Ruby-throated Hummingbirds to your backyard by setting up hummingbird feeders or by planting tubular flowers.'),
(NULL, 'Eastern Towhee', 'Scrub', 'Omnivore', 1, 'Eastern Towhees are likely to visit – or perhaps live in – your yard if you’ve got brushy, shrubby, or overgrown borders.'),
(NULL, 'Indigo Bunting', 'Open woodlands', 'Insects', 1, 'You can attract Indigo Buntings to your yard with feeders, particularly with small seeds such as thistle or nyjer.');

DROP TABLE IF EXISTS bird_images;
CREATE TABLE bird_images (
  id int(11) NOT NULL AUTO_INCREMENT,
  bird_id_fk int(11) NOT NULL,
  image_name varchar(100) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (bird_id_fk) REFERENCES birds(id)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `bird_images` (`id`, `bird_id_fk`, `image_name`) VALUES
(NULL, 1, "carolina-wren-01.jpg"),
(NULL, 2, "tufted-titmouse-01.jpg"),
(NULL, 3, "ruby-throated-hummingbird-01.jpg"),
(NULL, 4, "eastern-towhee-01.jpg"),
(NULL, 5, "indigo-bunting-01.jpg");

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_level` char(1) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

