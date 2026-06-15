<?php

class Config
{
    public const APP_NAME = 'Taman Asoka Asri CRM';
    public const FALLBACK_WHATSAPP = '6281234567890';

    public static function dataPath(string $file): string
    {
        return __DIR__ . '/../data/' . ltrim($file, '/');
    }
}

function app_now(): string
{
    return date('Y-m-d H:i:s');
}

function app_slug(string $value): string
{
    $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $value), '-'));

    return $slug !== '' ? $slug : 'item';
}

function app_base_url(): string
{
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));

    return $dir === '/' ? '' : rtrim($dir, '/');
}

function url(string $path = ''): string
{
    return app_base_url() . '/' . ltrim($path, '/');
}

function isActive(string $path, bool $exact = false): string
{
    $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $base = app_base_url();
    $normalizedPath = '/' . trim($path, '/');

    if ($base !== '' && str_starts_with($currentPath, $base)) {
        $currentPath = substr($currentPath, strlen($base)) ?: '/';
    }

    $currentPath = '/' . trim($currentPath, '/');
    $currentPath = $currentPath === '/' ? '/' : rtrim($currentPath, '/');

    $active = $exact
        ? $currentPath === $normalizedPath
        : ($currentPath === $normalizedPath || str_starts_with($currentPath, $normalizedPath . '/'));

    return $active ? 'bg-neutral-100 font-medium text-neutral-700' : 'hover:bg-neutral-50';
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

function render(string $view, array $data = [], ?string $layout = null): void
{
    extract($data, EXTR_SKIP);

    ob_start();
    require __DIR__ . '/../views/' . $view . '.php';
    $content = ob_get_clean();

    if ($layout) {
        require __DIR__ . '/../views/' . $layout . '.php';
        return;
    }

    echo $content;
}

function component(string $view, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require __DIR__ . '/../views/components/' . $view . '.php';
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function old(string $key, string $default = ''): string
{
    return e($_SESSION['old'][$key] ?? $default);
}

function flash(string $key): ?string
{
    if (!isset($_SESSION['flash'][$key])) {
        return null;
    }

    $message = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);

    return $message;
}

function leadCategoryBadgeClass(?string $category): string
{
    $classes = LeadCategories::badgeClasses();

    return $classes[$category ?? ''] ?? 'bg-slate-100 text-slate-700';
}

function badge(string $label, string $class): string
{
    return '<span class="inline-flex rounded-md border px-2 py-1 text-xs font-semibold ' . e($class) . '">' . e($label) . '</span>';
}

function formatDate(?string $date): string
{
    if (!$date) {
        return '';
    }

    $parsedDate = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $date)
        ?: DateTimeImmutable::createFromFormat('Y-m-d', $date);

    return $parsedDate ? $parsedDate->format('l, d F Y') : $date;
}

function initials(?string $name): string
{
    $words = preg_split('/\s+/', trim((string) $name));
    $letters = '';

    foreach ($words as $word) {
        if ($word === '') {
            continue;
        }

        $letters .= strtoupper(substr($word, 0, 1));

        if (strlen($letters) >= 2) {
            break;
        }
    }

    return $letters !== '' ? $letters : '?';
}

function avatarHtml(?string $image, ?string $name, string $class = 'h-9 w-9'): string
{
    if ($image) {
        return '<img src="' . e(url($image)) . '" alt="' . e($name ?? 'Avatar') . '" class="' . e($class) . ' rounded-full object-cover">';
    }

    return '<span class="inline-flex ' . e($class) . ' items-center justify-center rounded-full bg-slate-100 text-base font-medium border border-slate-200 text-slate-600">' . e(initials($name)) . '</span>';
}
