<h1 class="truncate text-xl tracking-tight font-medium sm:text-2xl mb-4">
    <?= e($title ?? 'Log History') ?>
</h1>

<?php
$logRows = [];

foreach ($logs as $index => $log) {
    $user = $userMap[(int) ($log['user_id'] ?? 0)] ?? null;
    $userName = $user ? e($user['name'] ?? 'Unknown') : 'System/Unknown';
    
    $logRows[] = [
        ['text' => (string) ($index + 1), 'header' => true],
        ['text' => formatDate($log['created_at'] ?? ''), 'class' => 'whitespace-nowrap'],
        ['html' => '<div class="flex items-center gap-2">' . avatarHtml($user['avatar'] ?? '', $userName, 'h-6 w-6') . '<span class="font-medium">' . $userName . '</span></div>'],
        ['html' => badge($log['action'] ?? '', 'bg-slate-100 border-slate-200 text-slate-700')],
        ['text' => e($log['description'] ?? '')],
        ['text' => $log['target_id'] ? '#' . e((string) $log['target_id']) : '-'],
    ];
}
?>

<?php component('table', [
    'class' => 'mt-5',
    'headers' => ['#', 'Waktu', 'User', 'Aksi', 'Deskripsi', 'Target ID'],
    'rows' => $logRows,
    'emptyMessage' => 'Belum ada aktivitas log.',
]); ?>

<?php component('pagination', ['pagination' => $pagination ?? null]); ?>
