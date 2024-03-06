<?php
if(!defined('db_host')) define('db_host', '185.237.144.56'); // Modify host if necessary
if(!defined('db_user')) define('db_user', 'u8152743_ipd'); // Modify username
if(!defined('db_pass')) define('db_pass', 'ipd@6400'); // Modify password
if(!defined('db_name')) define('db_name', 'u8152743_cashier_queuing_db'); // Modify database name
if(!defined('tZone')) define('tZone',"Asia/Singapore");
if(!defined('dZone')) define('dZone',date_default_timezone_get());

Class DBConnection extends mysqli {
    protected $db;
    function __construct() {
        parent::__construct(db_host, db_user, db_pass, db_name);
        if ($this->connect_error) {
            die('Connect Error (' . $this->connect_errno . ') ' . $this->connect_error);
        }
        $this->query("SET time_zone = '". $this->real_escape_string(tZone) ."'");

        $this->query("CREATE TABLE IF NOT EXISTS `user_list` (
            `user_id` INT AUTO_INCREMENT PRIMARY KEY,
            `fullname` VARCHAR(255) NOT NULL,
            `username` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `status` INT NOT NULL DEFAULT 1,
            `date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $this->query("CREATE TABLE IF NOT EXISTS `cashier_list` (
            `cashier_id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(255) NOT NULL,
            `log_status` INT NOT NULL DEFAULT 0,
            `status` INT NOT NULL DEFAULT 1
        )");

        $this->query("CREATE TABLE IF NOT EXISTS `queue_list` (
            `queue_id` INT AUTO_INCREMENT PRIMARY KEY,
            `queue` VARCHAR(255) NOT NULL,
            `customer_name` VARCHAR(255) NOT NULL,
            `status` INT NOT NULL DEFAULT 0,
            `date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $stmt = $this->prepare("INSERT IGNORE INTO `user_list` (`user_id`, `fullname`, `username`, `password`, `status`, `date_created`) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $stmt->bind_param("isssi", $user_id, $fullname, $username, $password, $status);
        $user_id = 1;
        $fullname = 'Administrator';
        $username = 'admin';
        $password = md5('admin123'); // You may want to use a more secure hashing algorithm for passwords
        $status = 1;
        $stmt->execute();
        $stmt->close();
    }

    function __destruct() {
        $this->close();
    }
}

$conn = new DBConnection();
