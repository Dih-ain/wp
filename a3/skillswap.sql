-- Run only if the database is NOT already created
-- Host: localhost
-- For Jacob 5 use export data as described in the "Exporting a table to RMIT SQL Server" document
-- This script creates users and skills tables

-- Create the SkillSwap database
CREATE DATABASE IF NOT EXISTS skillswap
DEFAULT CHARACTER
SET utf8mb4
DEFAULT
COLLATE utf8mb4_unicode_ci;
USE skillswap;


-- Skills table
CREATE TABLE IF NOT EXISTS skills
(
skill_id     INT AUTO_INCREMENT PRIMARY KEY,
title        VARCHAR(150)  NOT NULL,
description  TEXT          NOT NULL,
category     VARCHAR(50),
image_path   VARCHAR(255),
rate_per_hr  DECIMAL(8,2)  NOT NULL,
level        ENUM('Beginner','Intermediate','Expert') NOT NULL DEFAULT 'Intermediate',
created_at   DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO skills
(title, description, category, image_path, rate_per_hr, level)
VALUES
('Beginner Guitar Lessons', 'description', 'Music', 'assets/images/skills/1.png', 30.00, 'Beginner'),
('Intermediate Fingerstyle', 'description', 'Music', 'assets/images/skills/2.png', 45.00, 'Intermediate'),
('Artisan Bread Baking', 'description', 'Cooking', 'assets/images/skills/3.png', 25.00, 'Beginner'),
('French Pastry Making', 'description', 'Cooking', 'assets/images/skills/4.png', 50.00, 'Expert'),
('Watercolour Basics', 'description', 'Art', 'assets/images/skills/5.png', 20.00, 'Intermediate'),
('Digital Illustration with Procreate', 'description', 'Art', 'assets/images/skills/6.png', 40.00, 'Intermediate'),
('Morning Vinyasa Flow', 'description', 'Wellness', 'assets/images/skills/7.png', 35.00, 'Intermediate'),
('Intro to PHP & MySQL', 'description', 'Programming', 'assets/images/skills/8.png', 55.00, 'Expert');