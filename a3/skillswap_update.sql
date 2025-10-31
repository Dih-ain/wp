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

-- Run only if the database is already created
-- Database: skillswap
-- Host: localhost
-- For Jacob 5 use export data as described in the "Exporting a table to RMIT SQL Server" document
-- This script creates a users table and modifies the skills table to include a user_id column 
USE skillswap;

-- Step 1: Create the users table
CREATE TABLE IF NOT EXISTS users (
    user_id     INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50)   NOT NULL UNIQUE,
    email       VARCHAR(100)  NOT NULL UNIQUE,
    password    CHAR(60)      NOT NULL,        -- hashed passwords
    bio         TEXT,
    joined_at   DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Step 2: Add user_id column to the existing skills table
ALTER TABLE skills ADD COLUMN user_id INT; 

-- Step 3: Add foreign key constraint
ALTER TABLE skills
ADD CONSTRAINT fk_user_id
FOREIGN KEY (user_id) REFERENCES users(user_id)
ON DELETE CASCADE;

INSERT INTO users
(user_id, username, email, password, bio)
VALUES
(1, "Alice", 'alice@job.com', '$2y$10$PIPPzXZhlqpKKL4v33x02OSio8FDkGMpJAqgOBXFWXpxFLCkEr3s2', "Hello! Im Alice"),
(2, "Bob", 'bob@job.com', '$2y$10$PIPPzXZhlqpKKL4v33x02OSio8FDkGMpJAqgOBXFWXpxFLCkEr3s2', "Hello! Im Bob"),
(3, "Carol", 'carol@job.com', '$2y$10$PIPPzXZhlqpKKL4v33x02OSio8FDkGMpJAqgOBXFWXpxFLCkEr3s2', "Hello! Im Carol"),
(4, "Dave", 'dave@job.com', '$2y$10$PIPPzXZhlqpKKL4v33x02OSio8FDkGMpJAqgOBXFWXpxFLCkEr3s2', "Hello! Im Dave"),
(5, "Eve", 'eve@job.com', '$2y$10$PIPPzXZhlqpKKL4v33x02OSio8FDkGMpJAqgOBXFWXpxFLCkEr3s2', "Hello! Im Eve");

INSERT INTO skills
(title, description, category, image_path, rate_per_hr, level, user_id)
VALUES
('Beginner Guitar Lessons', 'description', 'Music', 'assets/images/skills/1.png', 30.00, 'Beginner',1),
('Intermediate Fingerstyle', 'description', 'Music', 'assets/images/skills/2.png', 45.00, 'Intermediate',2),
('Artisan Bread Baking', 'description', 'Cooking', 'assets/images/skills/3.png', 25.00, 'Beginner',3),
('French Pastry Making', 'description', 'Cooking', 'assets/images/skills/4.png', 50.00, 'Expert',4),
('Watercolour Basics', 'description', 'Art', 'assets/images/skills/5.png', 20.00, 'Intermediate',5),
('Digital Illustration with Procreate', 'description', 'Art', 'assets/images/skills/6.png', 40.00, 'Intermediate',1),
('Morning Vinyasa Flow', 'description', 'Wellness', 'assets/images/skills/7.png', 35.00, 'Intermediate',2),
('Intro to PHP & MySQL', 'description', 'Programming', 'assets/images/skills/8.png', 55.00, 'Expert',3);