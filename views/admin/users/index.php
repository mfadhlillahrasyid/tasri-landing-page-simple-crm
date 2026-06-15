<?php $currentUser = $currentUser ?? AuthController::currentUser(); ?>

<div class="mb-4 flex justify-between items-center">
    <h1 class="truncate text-xl tracking-tight font-medium sm:text-2xl">
        <?= e($title ?? 'Dashboard') ?>
    </h1>

    <?php if (($currentUser['role'] ?? '') === UserRoles::ADMIN): ?>
        <?php component('button', [
            'as' => 'a',
            'href' => url('/admin/users/create'),
            'label' => 'Create User',
            'class' => 'bg-blue-700 px-3 py-2 text-slate-100 hover:bg-blue-800',
        ]); ?>
        <?php endif; ?>
</div>
    
<?php if ($message = flash('error')): ?>
            <div class="mb-5 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700"><?= e($message) ?></div>
<?php endif; ?>
    
<?php
$userRows = [];

foreach ($users as $index => $user) {
    $statusClass = !empty($user['status'])
        ? 'bg-emerald-50 border-emerald-200 text-emerald-700'
        : 'bg-slate-100 border-slate-200 text-slate-600';
    $statusLabel = !empty($user['status']) ? 'Active' : 'Inactive';
    $statusBadge = badge($statusLabel, $statusClass);

    $isMarketing = ($user['role'] ?? '') === UserRoles::MARKETING;
    $isCurrentUser = (int) ($currentUser['id'] ?? 0) === (int) ($user['id'] ?? 0);
    $isCurrentAdmin = ($currentUser['role'] ?? '') === UserRoles::ADMIN;
    $actions = '';

    if ($isMarketing && ($isCurrentAdmin || $isCurrentUser)) {
        ob_start();
        component('button', [
            'as' => 'a',
            'href' => url('/admin/users/edit?id=' . ($user['id'] ?? 0)),
            'label' => 'Edit',
            'class' => 'bg-slate-700 px-2 py-1 text-slate-100 hover:bg-slate-800',
        ]);
        $actions .= ob_get_clean();
    }

    if ($isMarketing && $isCurrentAdmin) {
        $actions .= '<form class="inline" method="post" action="' . e(url('/admin/users/delete')) . '" data-confirm="Hapus user ini? Data yang dihapus tidak bisa dikembalikan." data-confirm-title="Hapus User" data-confirm-action="Hapus">';
        $actions .= '<input type="hidden" name="id" value="' . e((string) ($user['id'] ?? 0)) . '">';
        ob_start();
        component('button', [
            'label' => 'Delete',
            'class' => 'ml-1 bg-red-600 px-2 py-1 text-white hover:bg-red-700',
        ]);
        $actions .= ob_get_clean();
        $actions .= '</form>';
    }

    if (!$isMarketing || (!$isCurrentAdmin && !$isCurrentUser)) {
        $actions .= '<span class="text-slate-400">Protected</span>';
    }

    $userRows[] = [
        ['text' => (string) ($index + 1), 'header' => true],
        ['html' => '<div class="flex items-center gap-2">' . avatarHtml($user['avatar'] ?? '', $user['name'] ?? '') . '<span class="font-medium">' . e($user['name'] ?? '') . '</span></div>'],
        ['text' => $roleLabels[$user['role'] ?? ''] ?? ''],
        ['text' => $user['whatsapp'] ?? ''],
        ['html' => $statusBadge],
        ['text' => formatDate($user['created_at'] ?? '')],
        ['text' => formatDate($user['updated_at'] ?? '')],
        ['html' => $actions, 'class' => 'text-left'],
    ];
}

component('table', [
    'headers' => ['#', 'Nama', 'Role', 'WhatsApp', 'Status', 'Created At', 'Updated At', 'Aksi'],
    'rows' => $userRows,
    'emptyMessage' => 'Belum ada user.',
]);
?>
