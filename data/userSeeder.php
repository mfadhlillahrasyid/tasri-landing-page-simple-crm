<?php

require_once __DIR__ . '/../config/Config.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/Enum/userRoles.php';
require_once __DIR__ . '/../app/Enum/leadCategories.php';
require_once __DIR__ . '/../app/Repository/UserRepository.php';
require_once __DIR__ . '/../app/Repository/CustomerRepository.php';
require_once __DIR__ . '/../app/Repository/SettingRepository.php';

$pdo = Database::pdo();
$pdo->exec('DELETE FROM customer_closing_images');
$pdo->exec('DELETE FROM customers');
$pdo->exec('DELETE FROM users');
$pdo->exec('DELETE FROM settings');
$pdo->exec('DELETE FROM sqlite_sequence WHERE name IN ("customer_closing_images", "customers", "users")');

$now = app_now();

$users = [
    [
        'name' => 'Admin TASRI',
        'role' => UserRoles::ADMIN,
        'whatsapp' => '',
        'status' => true,
        'slug' => 'admin',
        'password' => 'Borjong33',
        'created_at' => $now,
        'updated_at' => $now,
    ],
    [
        'name' => 'Marketing Satu',
        'role' => UserRoles::MARKETING,
        'whatsapp' => '628111111111',
        'status' => true,
        'slug' => 'marketing-satu',
        'password' => '123456',
        'created_at' => $now,
        'updated_at' => $now,
    ],
    [
        'name' => 'Marketing Dua',
        'role' => UserRoles::MARKETING,
        'whatsapp' => '628122222222',
        'status' => true,
        'slug' => 'marketing-dua',
        'password' => '123456',
        'created_at' => $now,
        'updated_at' => $now,
    ],
    [
        'name' => 'Marketing Tiga',
        'role' => UserRoles::MARKETING,
        'whatsapp' => '628133333333',
        'status' => true,
        'slug' => 'marketing-tiga',
        'password' => '123456',
        'created_at' => $now,
        'updated_at' => $now,
    ],
];

foreach ($users as $user) {
    UserRepository::create($user);
}

SettingRepository::set(SettingRepository::MARKETING_LAST_INDEX, '0');
SettingRepository::setBool(SettingRepository::AUTO_ASSIGN_ROTATED_LEAD, false);
