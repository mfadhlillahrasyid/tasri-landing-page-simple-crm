<?php

class CustomerRepository
{
    public static function all(): array
    {
        $statement = Database::pdo()->query('SELECT * FROM customers ORDER BY id ASC');

        $customers = array_map([self::class, 'normalize'], $statement->fetchAll());
        $images = self::imagesForCustomers(array_column($customers, 'id'));

        return array_map(static function (array $customer) use ($images): array {
            $customer['closing_images'] = $images[$customer['id']] ?? [];

            return $customer;
        }, $customers);
    }

    public static function find(int $id): ?array
    {
        $statement = Database::pdo()->prepare('SELECT * FROM customers WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $customer = $statement->fetch();

        if (!$customer) {
            return null;
        }

        $customer = self::normalize($customer);
        $customer['closing_images'] = self::imagesForCustomer($customer['id']);

        return $customer;
    }

    public static function create(array $payload): int
    {
        $statement = Database::pdo()->prepare("
            INSERT INTO customers (name, whatsapp, city, slug, assigned_by, lead_category, created_at, updated_at)
            VALUES (:name, :whatsapp, :city, :slug, :assigned_by, :lead_category, :created_at, :updated_at)
        ");
        $statement->execute(self::persistable($payload));

        $customerId = (int) Database::pdo()->lastInsertId();
        self::insertImages($customerId, $payload['closing_images'] ?? []);

        return $customerId;
    }

    public static function updateCategory(int $id, string $leadCategory, array $closingImages = []): void
    {
        $customer = self::find($id);

        if (!$customer) {
            return;
        }

        $statement = Database::pdo()->prepare("
            UPDATE customers
            SET lead_category = :lead_category,
                updated_at = :updated_at
            WHERE id = :id
        ");
        $statement->execute([
            'id' => $id,
            'lead_category' => $leadCategory,
            'updated_at' => app_now(),
        ]);

        self::insertImages($id, $closingImages);
    }

    public static function addClosingImages(int $id, array $closingImages): void
    {
        if (empty($closingImages)) {
            return;
        }

        $customer = self::find($id);

        if (!$customer) {
            return;
        }

        self::insertImages($id, $closingImages);

        $statement = Database::pdo()->prepare('UPDATE customers SET updated_at = :updated_at WHERE id = :id');
        $statement->execute([
            'id' => $id,
            'updated_at' => app_now(),
        ]);
    }

    public static function assign(int $id, int $assignedBy): void
    {
        $statement = Database::pdo()->prepare("
            UPDATE customers
            SET assigned_by = :assigned_by,
                updated_at = :updated_at
            WHERE id = :id
        ");
        $statement->execute([
            'id' => $id,
            'assigned_by' => $assignedBy,
            'updated_at' => app_now(),
        ]);
    }

    public static function delete(int $id): void
    {
        $statement = Database::pdo()->prepare('DELETE FROM customers WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    private static function normalize(array $customer): array
    {
        $customer['id'] = (int) ($customer['id'] ?? 0);
        $customer['assigned_by'] = $customer['assigned_by'] === null ? null : (int) $customer['assigned_by'];
        $customer['closing_images'] = [];

        return $customer;
    }

    private static function persistable(array $payload): array
    {
        return [
            'name' => $payload['name'],
            'whatsapp' => $payload['whatsapp'],
            'city' => $payload['city'],
            'slug' => $payload['slug'],
            'assigned_by' => $payload['assigned_by'] ?? null,
            'lead_category' => $payload['lead_category'],
            'created_at' => $payload['created_at'],
            'updated_at' => $payload['updated_at'],
        ];
    }

    private static function imagesForCustomer(int $customerId): array
    {
        $images = self::imagesForCustomers([$customerId]);

        return $images[$customerId] ?? [];
    }

    private static function imagesForCustomers(array $customerIds): array
    {
        $customerIds = array_values(array_filter(array_map('intval', $customerIds)));

        if (empty($customerIds)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($customerIds), '?'));
        $statement = Database::pdo()->prepare("
            SELECT customer_id, path
            FROM customer_closing_images
            WHERE customer_id IN ({$placeholders})
            ORDER BY id ASC
        ");
        $statement->execute($customerIds);

        $images = [];
        foreach ($statement->fetchAll() as $row) {
            $images[(int) $row['customer_id']][] = $row['path'];
        }

        return $images;
    }

    private static function insertImages(int $customerId, array $paths): void
    {
        if (empty($paths)) {
            return;
        }

        $statement = Database::pdo()->prepare("
            INSERT INTO customer_closing_images (customer_id, path, created_at)
            VALUES (:customer_id, :path, :created_at)
        ");
        $now = app_now();

        foreach ($paths as $path) {
            if ((string) $path === '') {
                continue;
            }

            $statement->execute([
                'customer_id' => $customerId,
                'path' => (string) $path,
                'created_at' => $now,
            ]);
        }
    }
}
