<h1 class="truncate text-xl tracking-tight font-medium sm:text-2xl"><?= e($title ?? 'Dashboard') ?></h1>

<div class="grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-5 mt-4">
    <div class="rounded-xl bg-white border border-slate-200 p-4 col-span-2 sm:col-span-1">
        <p class="text-xs sm:text-sm text-slate-500">Total Customers</p>
        <p class="mt-2 text-3xl font-medium"><?= e((string) $totalCustomers) ?></p>
    </div>
    <?php foreach ($summary as $category => $count): ?>
        <div class="rounded-xl bg-white border border-slate-200 p-4">
            <p class="text-xs sm:text-sm text-slate-500"><?= e(LeadCategories::labels()[$category] ?? $category) ?></p>
            <p class="mt-2 text-3xl font-medium"><?= e((string) $count) ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php
$customerRows = [];

foreach ($customers as $index => $customer) {
    $category = $customer['lead_category'] ?? LeadCategories::COLD;

    $customerRows[] = [
        ['text' => (string) ($index + 1), 'header' => true],
        ['text' => $customer['name'] ?? '', 'class' => 'font-medium'],
        ['text' => $customer['whatsapp'] ?? ''],
        ['text' => $customer['city'] ?? ''],
        ['html' => badge(LeadCategories::labels()[$category] ?? $category, leadCategoryBadgeClass($category))],
        ['text' => formatDate($customer['created_at'] ?? '')],
    ];
}

component('table', [
    'title' => 'Customer Belum Assigned',
    'class' => 'mt-4',
    'headers' => ['#', 'Nama', 'WhatsApp', 'Kota', 'Kategori', 'Created At'],
    'rows' => $customerRows,
    'emptyMessage' => 'Tidak ada customer yang belum assigned.',
]);

component('pagination', ['pagination' => $pagination ?? null]);
?>
