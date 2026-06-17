<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Admin') ?> - Taman Asoka Asri</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= e(url('/assets/css/app.css')) ?>?v=font-2">
    
    <!-- Hotwire Turbo: Mengubah aplikasi menjadi SPA tanpa reload -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.4/dist/turbo.es2017-esm.js"></script>
</head>

<body class="bg-slate-100 text-slate-900 font-poppins">
    <?php $currentUser = AuthController::currentUser(); ?>
    <div class="min-h-screen lg:flex">
        <aside
            class="sticky top-0 z-30 border-b border-slate-200 bg-white lg:h-screen lg:w-64 lg:border-b-0 lg:border-r">
            <div class="flex h-16 flex-col items-start justify-center border-b border-slate-200 px-4 text-center">
                <a href="<?= e(url('/admin/dashboard')) ?>"
                    class="font-bold text-2xl tracking-tighter text-blue-800">TASRI</a>
                <p class="text-xs text-neutral-400">Customer Database</p>
            </div>
            <nav class="flex sm:flex-col gap-2 overflow-x-auto p-2 text-neutral-500">
                <a class="block py-1.5 px-4 rounded-md text-xs sm:text-sm <?= e(isActive('/admin/dashboard', true)) ?>"
                    href="<?= e(url('/admin/dashboard')) ?>">Dashboard</a>
                <a class="block py-1.5 px-4 rounded-md text-xs sm:text-sm <?= e(isActive('/admin/users')) ?>"
                    href="<?= e(url('/admin/users')) ?>">Users</a>
                <a class="block py-1.5 px-4 rounded-md text-xs sm:text-sm <?= e(isActive('/admin/customers')) ?>"
                    href="<?= e(url('/admin/customers')) ?>">Customers</a>
                <?php if (($currentUser['role'] ?? '') === UserRoles::ADMIN): ?>
                    <a class="block py-1.5 px-4 rounded-md text-xs sm:text-sm <?= e(isActive('/admin/settings')) ?>"
                        href="<?= e(url('/admin/settings')) ?>">Settings</a>
                <?php endif; ?>
                <a class="block py-1.5 px-4 rounded-md text-xs sm:text-sm <?= e(isActive('/admin/logs')) ?>"
                    href="<?= e(url('/admin/logs')) ?>">Logs</a>
                <!-- <a class="admin-nav-link" href="<?= e(url('/')) ?>">Landing</a> -->
            </nav>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
                <div class="flex items-center justify-between gap-4 h-16 px-4">
                    <div class="min-w-0">
                        <div class="flex items-center justify-center gap-3">
                            <?= avatarHtml($currentUser['avatar'] ?? '', $currentUser['name'] ?? 'CRM', 'h-10 w-10') ?>
                            <div class="flex flex-col">
                                <h3 class="text-sm font-medium text-blue-700">
                                    <?= e($currentUser['name'] ?? 'CRM') ?>
                                </h3>
                                <p class="text-xs text-neutral-400 capitalize -mt-0.5">
                                    <?= e($currentUser['role'] ?? 'user') ?>
                                </p>

                            </div>
                        </div>
                    </div>
                    <form action="<?= e(url('/logout')) ?>" method="post" data-confirm="Kamu yakin ingin logout?"
                        data-confirm-title="Logout" data-confirm-action="Logout">
                        <button
                            class="flex items-center gap-2 rounded-lg cursor-pointer border border-slate-300 px-2.5 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="mx-auto max-w-7xl p-4 sm:p-6 lg:p-8">
                <?= $content ?>
            </main>
        </div>
    </div>
    <?php component('modal', ['type' => 'confirm']); ?>
    <script type="module" src="<?= e(url('/assets/js/app.js')) ?>?v=5"></script>
</body>

</html>
