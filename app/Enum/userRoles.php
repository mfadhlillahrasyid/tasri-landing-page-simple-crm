<?php

class UserRoles
{
    public const ADMIN = 'admin';
    public const MARKETING = 'marketing';

    public static function all(): array
    {
        return [
            self::ADMIN,
            self::MARKETING,
        ];
    }

    public static function labels(): array
    {
        return [
            self::ADMIN => 'Admin',
            self::MARKETING => 'Marketing',
        ];
    }
}
