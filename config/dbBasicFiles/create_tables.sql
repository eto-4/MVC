CREATE TABLE `tasks` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT '',
  `tags` JSON DEFAULT '[]',
  `cost` DECIMAL(10,2) DEFAULT 0,
  `due_date` DATETIME NOT NULL DEFAULT (CURRENT_TIMESTAMP + INTERVAL 1 DAY),
  `expected_hours` INT DEFAULT 20,
  `used_hours` INT DEFAULT 0,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `image_local_name` VARCHAR(255) DEFAULT NULL,
  `image_cloud_public_id` VARCHAR(255) DEFAULT NULL,
  `priority` ENUM('low', 'medium', 'high') DEFAULT 'medium',
  `state` ENUM('pending', 'in-progress', 'blocked', 'completed') DEFAULT 'pending',
  `finished_at` DATETIME DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;