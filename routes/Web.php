<?php

return [
    'GET' => [
        '/' => [LandingController::class, 'home'],
        '/login' => [AuthController::class, 'loginForm'],
        '/admin/dashboard' => [DashboardController::class, 'index'],
        '/admin/customers' => [CustomersController::class, 'index'],
        '/admin/customers/view' => [CustomersController::class, 'view'],
        '/admin/users' => [UsersController::class, 'index'],
        '/admin/users/create' => [UsersController::class, 'create'],
        '/admin/users/edit' => [UsersController::class, 'edit'],
        '/admin/settings' => [SettingsController::class, 'index'],
        '/admin/logs' => [LogsController::class, 'index'],
    ],
    'POST' => [
        '/lead' => [LandingController::class, 'submitLead'],
        '/login' => [AuthController::class, 'login'],
        '/logout' => [AuthController::class, 'logout'],
        '/admin/customers/update-category' => [CustomersController::class, 'updateCategory'],
        '/admin/customers/upload-closing-images' => [CustomersController::class, 'uploadClosingImages'],
        '/admin/customers/assign' => [CustomersController::class, 'assign'],
        '/admin/customers/delete' => [CustomersController::class, 'delete'],
        '/admin/users/store' => [UsersController::class, 'store'],
        '/admin/users/update' => [UsersController::class, 'update'],
        '/admin/users/delete' => [UsersController::class, 'delete'],
        '/admin/settings/update' => [SettingsController::class, 'update'],
    ],
];
