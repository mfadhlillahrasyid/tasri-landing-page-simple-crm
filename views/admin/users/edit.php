<?php
$currentUser = $currentUser ?? AuthController::currentUser();
$isCurrentMarketing = ($currentUser['role'] ?? '') === UserRoles::MARKETING
    && (int) ($currentUser['id'] ?? 0) === (int) ($user['id'] ?? 0);
$isCurrentAdmin = ($currentUser['role'] ?? '') === UserRoles::ADMIN;
?>

<h1 class="truncate text-xl tracking-tight font-medium sm:text-2xl mb-4">
    <?= e($title ?? 'Dashboard') ?>
</h1>

<section class="rounded-xl border border-slate-200 bg-white p-5">
    <?php if (!empty($error)): ?>
        <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700"><?= e($error) ?></div>
    <?php endif; ?>

    <form class="space-y-4" method="post" action="<?= e(url('/admin/users/update')) ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= e((string) ($user['id'] ?? 0)) ?>">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <?php component('form/input', ['name' => 'name', 'label' => 'Nama', 'value' => $user['name'] ?? '', 'required' => true]); ?>
            <?php component('form/input', ['name' => 'whatsapp', 'label' => 'WhatsApp', 'value' => $user['whatsapp'] ?? '']); ?>
        </div>

        <?php if ($isCurrentAdmin): ?>
            <?php component('form/select', ['name' => 'role', 'label' => 'Role', 'options' => $roles, 'selected' => $user['role'] ?? UserRoles::MARKETING, 'required' => true, 'custom' => true]); ?>
        <?php else: ?>
            <input type="hidden" name="role" value="<?= e($user['role'] ?? UserRoles::MARKETING) ?>">
        <?php endif; ?>

        <?php component('form/dropzone', [
            'name' => 'avatar',
            'label' => 'Foto User',
            'maxFiles' => 1,
            'maxSize' => 2,
            'existing' => !empty($user['avatar']) ? [$user['avatar']] : [],
            'initials' => initials($user['name'] ?? ''),
        ]); ?>

        <?php if ($isCurrentMarketing): ?>
            <?php component('form/password', ['name' => 'current_password', 'label' => 'Password Lama', 'placeholder' => 'Masukkan Password Lama']); ?>
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <?php component('form/password', ['name' => 'password', 'label' => 'Password Baru', 'placeholder' => 'Masukkan Password Baru']); ?>
            <?php component('form/password', ['name' => 'retype_password', 'label' => 'Retype Password Baru', 'placeholder' => 'Konfirmasi Password Baru']); ?>
        </div>
        
        <?php component('form/toggle', ['name' => 'status', 'label' => 'Active', 'checked' => !empty($user['status'])]); ?>
        <div class="flex gap-3">
            <?php component('button', ['label' => 'Update User']); ?>
            <?php component('button', [
                'as' => 'a',
                'href' => url('/admin/users'),
                'label' => 'Cancel',
                'class' => 'border border-slate-300 bg-white text-slate-700 hover:bg-slate-50',
            ]); ?>
        </div>
    </form>
</section>
