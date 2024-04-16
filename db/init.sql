CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE
);

-- Insert dummy users
INSERT INTO `users` (`username`, `password`, `email`) VALUES
('user1', 'password1', 'user1@example.com'),
('user2', 'password2', 'user2@example.com');
