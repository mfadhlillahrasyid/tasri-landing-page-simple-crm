<?php

class SettingRepository
{
    public const AUTO_ASSIGN_ROTATED_LEAD = 'auto_assign_rotated_lead';
    public const MARKETING_LAST_INDEX = 'marketing_last_index';

    public static function get(string $key, string $default = ''): string
    {
        $statement = Database::pdo()->prepare('SELECT value FROM settings WHERE key = :key LIMIT 1');
        $statement->execute(['key' => $key]);
        $value = $statement->fetchColumn();

        return $value === false ? $default : (string) $value;
    }

    public static function bool(string $key, bool $default = false): bool
    {
        $value = self::get($key, $default ? '1' : '0');

        return in_array($value, ['1', 'true', 'yes', 'on'], true);
    }

    public static function set(string $key, string $value): void
    {
        $statement = Database::pdo()->prepare("
            INSERT INTO settings (key, value)
            VALUES (:key, :value)
            ON CONFLICT(key) DO UPDATE SET value = excluded.value
        ");
        $statement->execute([
            'key' => $key,
            'value' => $value,
        ]);
    }

    public static function setBool(string $key, bool $value): void
    {
        self::set($key, $value ? '1' : '0');
    }
}
