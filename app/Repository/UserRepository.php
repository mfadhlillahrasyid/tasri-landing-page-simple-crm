<?php

class UserRepository
{
    public static function all(): array
    {
        $statement = Database::pdo()->query('SELECT * FROM users ORDER BY id ASC');

        return array_map([self::class, 'normalize'], $statement->fetchAll());
    }

    public static function find(int $id): ?array
    {
        $statement = Database::pdo()->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $user = $statement->fetch();

        return $user ? self::normalize($user) : null;
    }

    public static function activeMarketings(): array
    {
        $statement = Database::pdo()->prepare("
            SELECT * FROM users
            WHERE role = :role AND status = 1 AND whatsapp != ''
            ORDER BY id ASC
        ");
        $statement->execute(['role' => UserRoles::MARKETING]);

        return array_map([self::class, 'normalize'], $statement->fetchAll());
    }

    public static function isActiveMarketing(int $userId): bool
    {
        $statement = Database::pdo()->prepare("
            SELECT COUNT(*) FROM users
            WHERE id = :id AND role = :role AND status = 1
        ");
        $statement->execute([
            'id' => $userId,
            'role' => UserRoles::MARKETING,
        ]);

        return (int) $statement->fetchColumn() > 0;
    }

    public static function create(array $payload): int
    {
        $statement = Database::pdo()->prepare("
            INSERT INTO users (name, role, whatsapp, status, slug, password, avatar, created_at, updated_at)
            VALUES (:name, :role, :whatsapp, :status, :slug, :password, :avatar, :created_at, :updated_at)
        ");
        $statement->execute(self::persistable($payload));

        return (int) Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $payload): void
    {
        $payload['id'] = $id;
        $statement = Database::pdo()->prepare("
            UPDATE users
            SET name = :name,
                role = :role,
                whatsapp = :whatsapp,
                status = :status,
                slug = :slug,
                password = :password,
                avatar = :avatar,
                updated_at = :updated_at
            WHERE id = :id
        ");
        $statement->execute([
            'id' => $payload['id'],
            'name' => $payload['name'],
            'role' => $payload['role'],
            'whatsapp' => $payload['whatsapp'] ?? '',
            'status' => !empty($payload['status']) ? 1 : 0,
            'slug' => $payload['slug'],
            'password' => $payload['password'],
            'avatar' => $payload['avatar'] ?? '',
            'updated_at' => $payload['updated_at'],
        ]);
    }

    public static function deleteMarketing(int $id): void
    {
        $statement = Database::pdo()->prepare('DELETE FROM users WHERE id = :id AND role = :role');
        $statement->execute([
            'id' => $id,
            'role' => UserRoles::MARKETING,
        ]);
    }

    private static function normalize(array $user): array
    {
        $user['id'] = (int) ($user['id'] ?? 0);
        $user['status'] = (bool) ($user['status'] ?? false);
        $user['avatar'] = (string) ($user['avatar'] ?? '');

        return $user;
    }

    private static function persistable(array $payload): array
    {
        return [
            'name' => $payload['name'],
            'role' => $payload['role'],
            'whatsapp' => $payload['whatsapp'] ?? '',
            'status' => !empty($payload['status']) ? 1 : 0,
            'slug' => $payload['slug'],
            'password' => $payload['password'],
            'avatar' => $payload['avatar'] ?? '',
            'created_at' => $payload['created_at'],
            'updated_at' => $payload['updated_at'],
        ];
    }
}
