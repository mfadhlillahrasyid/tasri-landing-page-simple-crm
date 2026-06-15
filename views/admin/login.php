<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Taman Asoka Asri CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= e(url('/assets/css/app.css')) ?>?v=font-2">
</head>

<body class="min-h-screen bg-slate-100 text-slate-900 font-poppins">
    <main class="mx-auto flex min-h-screen max-w-md items-center px-4">
        <section class="w-full rounded-xl bg-white border border-slate-200 p-6 shadow-2xl shadow-slate-300/50">
            <p class="text-sm font-semibold text-blue-700">TASRI CRM</p>
            <h1 class="mt-1 text-2xl font-medium">Login CRM</h1>
            <p class="mt-2 text-sm text-slate-400 max-w-xs">Masuk menggunakan WhatsApp dan password user aktif.</p>

            <?php if (!empty($error)): ?>
                <div class="mt-4 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700"><?= e($error) ?>
                </div>
            <?php endif; ?>

            <form class="mt-5 space-y-4" method="post" action="<?= e(url('/login')) ?>">
                <?php component('form/input', ['name' => 'whatsapp', 'label' => 'WhatsApp', 'placeholder' => 'Input Nomor Whatsapp', 'required' => true]); ?>
                <?php component('form/password', ['name' => 'password', 'label' => 'Password', 'placeholder' => 'Input Password', 'required' => true]); ?>
                <div class="flex items-center justify-between">
                    <?php component('form/checkbox', ['name' => 'remember', 'label' => 'Ingat saya']); ?>
                    <?php component('button', ['label' => 'Login']); ?>
                </div>
            </form>
        </section>
    </main>
    <script type="module" src="<?= e(url('/assets/js/app.js')) ?>?v=5"></script>
</body></html>
