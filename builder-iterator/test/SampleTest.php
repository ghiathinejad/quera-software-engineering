<?php

use App\User;
use PHPUnit\Framework\TestCase;
use System\Iterator\ModelIterator;

final class SampleTest extends TestCase
{
    protected static $answer_file_path = __DIR__ . '/../index.php';
    protected static $db_host = 'localhost';
    protected static $db_username = 'root';
    protected static $db_password = '';
    protected static $db_name = 'quera';
    protected static $table_name = 'users';
    protected static $post;
    protected static $db;
    protected static $users;

    public static function setUpBeforeClass(): void
    {
        require __DIR__ . '/../vendor/autoload.php';
        $db = new PDO('mysql:host=' . self::$db_host, self::$db_username, self::$db_password);
        $db->exec('DROP DATABASE IF EXISTS ' . self::$db_name);
        $db->exec('CREATE DATABASE ' . self::$db_name);
        $db = null;
        self::$db = new PDO('mysql:host=' . self::$db_host . ';dbname=' . self::$db_name, self::$db_username, self::$db_password);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = 'DROP TABLE IF EXISTS ' . self::$table_name;
        self::$db->exec($query);
        $query = "

        CREATE TABLE `users` (
          `id` bigint(20) NOT NULL,
          `email` varchar(191) NOT NULL,
          `first_name` varchar(191) NOT NULL,
          `last_name` varchar(191) NOT NULL,
          `avatar` varchar(191) NOT NULL,
          `password` varchar(191) NOT NULL,
          `status` tinyint(5) NOT NULL DEFAULT '0',
          `is_active` tinyint(5) NOT NULL DEFAULT '0',
          `verify_token` varchar(191) DEFAULT NULL,
          `user_type` varchar(191) NOT NULL,
          `remember_token` varchar(191) DEFAULT NULL,
          `remember_token_expire` datetime DEFAULT NULL,
          `created_at` datetime NOT NULL,
          `updated_at` datetime DEFAULT NULL,
          `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
        --
        -- Indexes for table `users`
        --
        ALTER TABLE `users`
          ADD PRIMARY KEY (`id`);
        
        --
        -- AUTO_INCREMENT for table `users`
        --
        ALTER TABLE `users`
          MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
        COMMIT;
        
            ";
        self::$db->exec($query);
        for ($i = 0; $i < 100; $i++) {
            $stmt = self::$db->prepare(
                "INSERT INTO `users` (`email`, `first_name`, `last_name`, `avatar`, `password`, `status`, `is_active`, `verify_token`, `user_type`, `remember_token`, `remember_token_expire`, `created_at`, `updated_at`, `deleted_at`) VALUES ('Moein{$i}', 'Moein{$i}', 'Moein{$i}', 'Moein{$i}.png', 'password', '0', '0', 'token', 'token', 'token', NULL, '" . date('Y-m-d H:i:s') . "', NULL, NULL)"
            );
            $stmt->execute();
        }
        self::$users = self::$db->query("SELECT * FROM `users`")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function testModelAll()
    {
        $users = User::all();

        $this->assertEquals(self::$users, $users);
    }

    public static function tearDownAfterClass(): void
    {
        $db = new PDO('mysql:host=' . self::$db_host, self::$db_username, self::$db_password);
        $db->exec('DROP DATABASE IF EXISTS ' . self::$db_name);
    }
}