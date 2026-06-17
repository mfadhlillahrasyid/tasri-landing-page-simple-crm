<?php

class LogRepository
{
    private static function getFilePath(): string
    {
        return __DIR__ . '/../../data/logs.json';
    }

    public static function create(array $payload): void
    {
        $logs = self::all();
        $payload['id'] = count($logs) > 0 ? ($logs[0]['id'] ?? 0) + 1 : 1;
        
        array_unshift($logs, $payload);
        
        $dir = dirname(self::getFilePath());
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        
        file_put_contents(self::getFilePath(), json_encode($logs, JSON_PRETTY_PRINT));
    }

    public static function all(): array
    {
        if (!file_exists(self::getFilePath())) {
            return [];
        }
        
        $data = json_decode(file_get_contents(self::getFilePath()), true);
        return is_array($data) ? $data : [];
    }
}