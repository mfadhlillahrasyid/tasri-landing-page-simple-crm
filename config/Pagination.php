<?php

class Pagination
{
    public const PER_PAGE = 20;

    public static function make(array $items, int $perPage = self::PER_PAGE): array
    {
        $total = count($items);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $currentPage = max(1, (int) ($_GET['page'] ?? 1));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        return [
            'items' => array_slice($items, $offset, $perPage),
            'meta' => [
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'total' => $total,
                'total_pages' => $totalPages,
                'prev_url' => $currentPage > 1 ? self::url($currentPage - 1) : null,
                'next_url' => $currentPage < $totalPages ? self::url($currentPage + 1) : null,
            ],
        ];
    }

    private static function url(int $page): string
    {
        $query = $_GET;
        $query['page'] = $page;
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
        $base = app_base_url();

        if ($base !== '' && str_starts_with($path, $base)) {
            $path = substr($path, strlen($base)) ?: '/';
        }

        return url($path) . '?' . http_build_query($query);
    }
}
