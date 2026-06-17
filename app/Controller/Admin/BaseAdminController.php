<?php

abstract class BaseAdminController
{
    protected const IMAGE_MAX_SIZE = 2097152;

    protected function findById(array $items, int $id): ?array
    {
        foreach ($items as $item) {
            if ((int) ($item['id'] ?? 0) === $id) {
                return $item;
            }
        }

        return null;
    }

    protected function userMap(array $users): array
    {
        $map = [];
        foreach ($users as $user) {
            $map[(int) ($user['id'] ?? 0)] = $user;
        }

        return $map;
    }

    protected function isActiveMarketingUser(array $users, int $userId): bool
    {
        foreach ($users as $user) {
            if ((int) ($user['id'] ?? 0) === $userId
                && ($user['role'] ?? '') === UserRoles::MARKETING
                && !empty($user['status'])
            ) {
                return true;
            }
        }

        return false;
    }

    protected function uploadImages(string $field, string $directory, int $maxFiles = 1, int $maxSize = self::IMAGE_MAX_SIZE): ?array
    {
        if (empty($_FILES[$field])) {
            return [];
        }

        $files = $this->normalizeFiles($_FILES[$field]);
        $files = array_values(array_filter($files, static fn ($file) => (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE));

        if (empty($files)) {
            return [];
        }

        if (count($files) > $maxFiles) {
            $_SESSION['flash']['error'] = 'Maksimal upload ' . $maxFiles . ' gambar.';
            return null;
        }

        $uploadDir = __DIR__ . '/../../../assets/uploads/' . trim($directory, '/');
        $publicDir = '/assets/uploads/' . trim($directory, '/');

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $paths = [];
        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
        ];

        foreach ($files as $file) {
            if ((int) ($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
                $_SESSION['flash']['error'] = 'Upload gambar gagal.';
                return null;
            }

            if ((int) ($file['size'] ?? 0) > $maxSize) {
                $_SESSION['flash']['error'] = 'Ukuran gambar maksimal 2MB.';
                return null;
            }

            $type = mime_content_type($file['tmp_name']);

            if (!isset($allowedTypes[$type])) {
                $_SESSION['flash']['error'] = 'File harus berupa gambar.';
                return null;
            }

            $filename = uniqid('img-', true) . '.' . $allowedTypes[$type];
            $target = $uploadDir . '/' . $filename;

            if (!move_uploaded_file($file['tmp_name'], $target)) {
                $_SESSION['flash']['error'] = 'Gagal menyimpan gambar.';
                return null;
            }

            $paths[] = $publicDir . '/' . $filename;
        }

        return $paths;
    }

    private function normalizeFiles(array $files): array
    {
        if (!is_array($files['name'])) {
            return [$files];
        }

        $normalized = [];
        foreach ($files['name'] as $index => $name) {
            $normalized[] = [
                'name' => $name,
                'type' => $files['type'][$index] ?? '',
                'tmp_name' => $files['tmp_name'][$index] ?? '',
                'error' => $files['error'][$index] ?? UPLOAD_ERR_NO_FILE,
                'size' => $files['size'][$index] ?? 0,
            ];
        }

        return $normalized;
    }

    protected function logActivity(string $action, string $description, ?int $targetId = null): void
    {
        $currentUser = AuthController::currentUser();
        $userId = $currentUser ? (int) ($currentUser['id'] ?? 0) : 0;

        if (class_exists('LogRepository')) {
            LogRepository::create([
                'user_id' => $userId,
                'action' => $action,
                'description' => $description,
                'target_id' => $targetId,
                'created_at' => function_exists('app_now') ? app_now() : date('Y-m-d H:i:s'),
            ]);
        }
    }
}
