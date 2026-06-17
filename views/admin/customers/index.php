<?php
$currentUser = $currentUser ?? AuthController::currentUser();
$isCurrentAdmin = ($currentUser['role'] ?? '') === UserRoles::ADMIN;
$isCurrentMarketing = ($currentUser['role'] ?? '') === UserRoles::MARKETING;
$marketingOptions = ['' => 'Semua marketing', 'none' => 'Belum assigned'];
$assignMarketingOptions = ['' => 'Pilih marketing'];

foreach ($users as $user) {
    if (($user['role'] ?? '') !== UserRoles::MARKETING) {
        continue;
    }

    $marketingOptions[(string) ($user['slug'] ?? '')] = $user['name'] ?? '';

    if (!empty($user['status'])) {
        $assignMarketingOptions[(string) ($user['id'] ?? '')] = $user['name'] ?? '';
    }
}

$customerRows = [];
?>

<?php if ($message = flash('error')): ?>
    <div class="mb-5 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700"><?= e($message) ?></div>
<?php endif; ?>

<h1 class="truncate text-xl tracking-tight font-medium sm:text-2xl mb-4">
    <?= e($title ?? 'Dashboard') ?>
</h1>

<section class="rounded-xl border border-slate-200 bg-white p-4">
    <form class="grid gap-4 md:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_minmax(0,1fr)_auto]" method="get"
        action="<?= e(url('/admin/customers')) ?>">
        <?php component('form/input', ['name' => 'search', 'label' => 'Search', 'value' => $_GET['search'] ?? '', 'placeholder' => 'Cari customer']); ?>
        <?php component('form/select', ['name' => 'category', 'label' => 'Lead Category', 'selected' => $_GET['category'] ?? '', 'options' => ['' => 'Semua kategori'] + ($leadCategoryOptions ?? $leadCategories), 'custom' => true]); ?>
        <?php component('form/select', ['name' => 'assigned_by', 'label' => 'Marketing', 'selected' => $_GET['assigned_by'] ?? '', 'options' => $marketingOptions, 'custom' => true]); ?>
        <div class="flex items-end gap-2">
            <?php component('button', ['label' => 'Filter', 'class' => 'bg-blue-700 px-3 py-1.5 text-white hover:bg-blue-800']); ?>
            <?php component('button', [
                'as' => 'a',
                'href' => url('/admin/customers'),
                'label' => 'Reset',
                'class' => 'border border-slate-300 bg-white px-3 py-1.5 text-slate-700 hover:bg-slate-50',
            ]); ?>
        </div>
    </form>
</section>

<?php foreach ($customers as $index => $customer): ?>
    <?php
    $customerId = (int) ($customer['id'] ?? 0);
    $modalId = 'customer-modal-' . $customerId;
    $assigned = $userMap[(int) ($customer['assigned_by'] ?? 0)] ?? null;
    $category = $customer['lead_category'] ?? LeadCategories::COLD;
    $isClosed = $category === LeadCategories::CLOSING;
    $assignedHtml = empty($customer['assigned_by'])
        ? badge('Belum assigned', 'bg-slate-100 border-slate-200 text-slate-700')
        : '<div class="flex items-center gap-2">'
        . avatarHtml($assigned['avatar'] ?? '', $assigned['name'] ?? 'Unknown', 'h-8 w-8')
        . '<span class="font-normal">' . e($assigned['name'] ?? 'Unknown') . '</span>'
        . '</div>';
    $actions = '';

    ob_start();
    component('button', [
        'type' => 'button',
        'label' => 'View',
        'class' => 'bg-slate-700 px-2 py-1 text-white hover:bg-slate-800',
        'attributes' => ['data-customer-modal-open' => $modalId],
    ]);
    $actions .= ob_get_clean();

    // Setelah: $actions .= ob_get_clean(); (tombol View)
    if (!empty($customer['whatsapp']) && !empty($customer['assigned_by'])) {
        $waNumber = preg_replace('/[^0-9]/', '', $customer['whatsapp']);
        if (str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        }
        $assignedName = $assigned['name'] ?? 'Marketing';
        $customerName = $customer['name'] ?? 'Bapak/Ibu';
        $waMessage = urlencode(
            "Halo Ibu/Bapak {$customerName}, saya {$assignedName} dari Taman Asoka Asri. " .
            "Saya ingin menginformasikan mengenai properti kami yang saat ini sedang tersedia. " .
            "Apakah Bapak/Ibu berkenan untuk berdiskusi lebih lanjut?"
        );
        ob_start();
        component('button', [
            'as' => 'a',
            'href' => 'https://wa.me/' . e($waNumber) . '?text=' . $waMessage,
            'target' => '_blank',
            'label' => 'Whatsapp',
            'class' => 'ml-1 bg-green-600 px-2 py-1 text-white hover:bg-green-700',
        ]);
        $actions .= ob_get_clean();
    }

    if (!$isClosed && $isCurrentMarketing && empty($customer['assigned_by'])) {
        $actions .= '<form class="inline" method="post" action="' . e(url('/admin/customers/assign')) . '" data-confirm="Assign customer ini ke kamu?" data-confirm-title="Assign Customer" data-confirm-action="Assign">';
        $actions .= '<input type="hidden" name="id" value="' . e((string) $customerId) . '">';
        ob_start();
        component('button', [
            'label' => 'Assign',
            'class' => 'ml-1 bg-blue-700 px-2 py-1 text-white hover:bg-blue-800',
        ]);
        $actions .= ob_get_clean();
        $actions .= '</form>';
    }

    if ($isCurrentAdmin) {
        $actions .= '<form class="inline" method="post" action="' . e(url('/admin/customers/delete')) . '" data-confirm="Hapus customer ini? Data yang dihapus tidak bisa dikembalikan." data-confirm-title="Hapus Customer" data-confirm-action="Hapus">';
        $actions .= '<input type="hidden" name="id" value="' . e((string) $customerId) . '">';
        ob_start();
        component('button', [
            'label' => 'Delete',
            'class' => 'ml-1 bg-red-600 px-2 py-1 text-white hover:bg-red-700',
        ]);
        $actions .= ob_get_clean();
        $actions .= '</form>';
    }

    $customerRows[] = [
        ['text' => (string) ($index + 1), 'header' => true],
        ['text' => $customer['name'] ?? '', 'class' => 'font-medium'],
        ['text' => $customer['whatsapp'] ?? ''],
        ['text' => $customer['city'] ?? ''],
        ['html' => $assignedHtml],
        ['html' => badge($leadCategories[$category] ?? $category, leadCategoryBadgeClass($category))],
        ['text' => formatDate($customer['created_at'] ?? '')],
        ['html' => $actions, 'class' => 'text-left'],
    ];
?>
<?php endforeach; ?>

<div id="realtime-customer-table">
<?php component('table', [
    'class' => 'mt-5',
    'headers' => ['#', 'Nama', 'WhatsApp', 'Kota', 'Marketing', 'Kategori', 'Created At', 'Aksi'],
    'rows' => $customerRows,
    'emptyMessage' => 'Belum ada customer.',
]); ?>
</div>

<?php component('pagination', ['pagination' => $pagination ?? null]); ?>

<?php foreach ($customers as $customer): ?>
    <?php
    $customerId = (int) ($customer['id'] ?? 0);
    $assigned = $userMap[(int) ($customer['assigned_by'] ?? 0)] ?? null;
    $category = $customer['lead_category'] ?? LeadCategories::COLD;
    $isClosed = $category === LeadCategories::CLOSING;
    $canManageCustomer = $isCurrentAdmin
        || ($isCurrentMarketing
            && !empty($customer['assigned_by'])
            && (int) ($customer['assigned_by'] ?? 0) === (int) ($currentUser['id'] ?? 0));
    ob_start();
    ?>
    <h2 class="text-lg sm:text-xl font-semibold text-slate-900 capitalize">
        <?= e($customer['name'] ?? 'Customer') ?>
    </h2>
    <p class="mt-1 text-sm text-slate-500">
        <?= e($customer['whatsapp'] ?? '') ?>
    </p>

    <?php if (!empty($customer['whatsapp']) && !empty($customer['assigned_by'])): ?>
        <?php
        $waNumber = preg_replace('/[^0-9]/', '', $customer['whatsapp']);
        if (str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        }
        $assignedName = $assigned['name'] ?? 'Marketing';
        $customerName = $customer['name'] ?? 'Bapak/Ibu';
        $waMessage = urlencode(
            "Halo Ibu/Bapak {$customerName}, saya {$assignedName} dari Taman Asoka Asri. " .
            "Saya ingin menginformasikan mengenai properti kami yang saat ini sedang tersedia. " .
            "Apakah Bapak/Ibu berkenan untuk berdiskusi lebih lanjut?"
        );
        ?>
        <?php component('button', [
            'as' => 'a',
            'href' => 'https://wa.me/' . e($waNumber) . '?text=' . $waMessage,
            'label' => 'Hubungi via WhatsApp',
            'class' => 'mt-2 bg-green-600 px-3 py-1.5 text-white hover:bg-green-700',
            'attributes' => ['target' => '_blank'],
        ]); ?>
    <?php endif; ?>

    <?php if ($isClosed): ?>
        <div class="mt-4 rounded-md border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm text-emerald-700">
            Customer sudah closing dan data tidak bisa diedit lagi.
        </div>
        <?php $closingImages = is_array($customer['closing_images'] ?? null) ? $customer['closing_images'] : []; ?>
        <?php if ($canManageCustomer && count($closingImages) < 5): ?>
            <form class="mt-4 space-y-3 border-t border-slate-100 pt-5" method="post"
                action="<?= e(url('/admin/customers/upload-closing-images')) ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= e((string) $customerId) ?>">
                <?php component('form/dropzone', [
                    'name' => 'closing_images',
                    'label' => 'Gambar Closing',
                    'multiple' => true,
                    'maxFiles' => 5 - count($closingImages),
                    'maxSize' => 2,
                    'existing' => $closingImages,
                ]); ?>
                <?php component('button', ['label' => 'Upload Gambar', 'class' => 'bg-blue-700 px-3 py-1.5 text-white hover:bg-blue-800']); ?>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <div class="mt-4 grid gap-4 border-t border-slate-100 pt-5 sm:grid-cols-2">
            <?php if ($canManageCustomer): ?>
                <form class="space-y-3" method="post" action="<?= e(url('/admin/customers/update-category')) ?>"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= e((string) $customerId) ?>">
                    <?php component('form/select', ['name' => 'lead_category', 'label' => 'Update Lead Category', 'options' => $leadCategoryOptions ?? $leadCategories, 'selected' => $category, 'required' => true, 'custom' => true]); ?>
                    <?php component('form/dropzone', [
                        'name' => 'closing_images',
                        'label' => 'Gambar Closing',
                        'multiple' => true,
                        'maxFiles' => 5,
                        'maxSize' => 2,
                        'existing' => $customer['closing_images'] ?? [],
                        'showWhenName' => 'lead_category',
                        'showWhenValue' => LeadCategories::CLOSING,
                    ]); ?>
                    <?php component('button', ['label' => 'Update Category', 'class' => 'bg-blue-700 px-3 py-1.5 text-white hover:bg-blue-800']); ?>
                </form>
            <?php else: ?>
                <div class="rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-600">
                    Lead ini hanya bisa dilihat. Update kategori hanya bisa dilakukan oleh marketing pemilik lead.
                </div>
            <?php endif; ?>

            <?php if ($isCurrentAdmin): ?>
                <form class="space-y-3" method="post" action="<?= e(url('/admin/customers/assign')) ?>">
                    <input type="hidden" name="id" value="<?= e((string) $customerId) ?>">
                    <?php component('form/select', ['name' => 'assigned_by', 'label' => 'Assign Marketing', 'options' => $assignMarketingOptions, 'selected' => $customer['assigned_by'] ?? '', 'required' => true, 'custom' => true]); ?>
                    <?php component('button', ['label' => 'Assign Customer', 'class' => 'bg-slate-700 px-3 py-1.5 text-white hover:bg-slate-800']); ?>
                </form>
            <?php elseif ($isCurrentMarketing && empty($customer['assigned_by'])): ?>
                <form class="space-y-3" method="post" action="<?= e(url('/admin/customers/assign')) ?>"
                    data-confirm="Assign customer ini ke kamu?" data-confirm-title="Assign Customer" data-confirm-action="Assign">
                    <input type="hidden" name="id" value="<?= e((string) $customerId) ?>">
                    <p class="text-sm text-slate-500">Customer ini belum di-assign.</p>
                    <?php component('button', ['label' => 'Assign ke Saya', 'class' => 'bg-blue-700 px-3 py-1.5 text-white hover:bg-blue-800']); ?>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="mt-5 grid gap-4 sm:grid-cols-2">
        <div>
            <p class="text-xs font-medium uppercase text-slate-400">Kota</p>
            <p class="mt-1 text-sm font-semibold text-slate-700"><?= e($customer['city'] ?? '') ?></p>
        </div>
        <div>
            <p class="text-xs font-medium uppercase text-slate-400">Marketing</p>
            <div class="mt-1 text-sm font-semibold text-slate-700">
                <?= empty($customer['assigned_by'])
                    ? badge('Belum assigned', 'bg-slate-100 border-slate-200 text-slate-700')
                    : '<div class="flex items-center gap-2">'
                    . avatarHtml($assigned['avatar'] ?? '', $assigned['name'] ?? 'Unknown', 'h-8 w-8')
                    . '<span>' . e($assigned['name'] ?? 'Unknown') . '</span>'
                    . '</div>' ?>
            </div>
        </div>
        <div>
            <p class="text-xs font-medium uppercase text-slate-400">Kategori</p>
            <div class="mt-1">
                <?= badge($leadCategories[$category] ?? $category, leadCategoryBadgeClass($category)) ?>
            </div>
        </div>
        <div>
            <p class="text-xs font-medium uppercase text-slate-400">Created At</p>
            <p class="mt-1 text-sm font-semibold text-slate-700"><?= e(formatDate($customer['created_at'] ?? '')) ?></p>
        </div>
        <div>
            <p class="text-xs font-medium uppercase text-slate-400">Updated At</p>
            <p class="mt-1 text-sm font-semibold text-slate-700"><?= e(formatDate($customer['updated_at'] ?? '')) ?></p>
        </div>

        <?php if (!empty($customer['closing_images'])): ?>
            <div class="sm:col-span-2">
                <p class="text-xs font-medium uppercase text-slate-400">Gambar Closing</p>
                <div class="mt-2 grid grid-cols-3 sm:grid-cols-5 gap-2">
                    <?php foreach ($customer['closing_images'] as $image): ?>
                        <img src="<?= e(url($image)) ?>" alt="Gambar closing" class="aspect-square rounded-lg object-cover">
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
    component('modal', [
        'id' => 'customer-modal-' . $customerId,
        'class' => 'max-w-2xl',
        'content' => ob_get_clean(),
    ]);
?>
<?php endforeach; ?>

<script>
    // Hapus interval sebelumnya jika berpindah menu (mencegah bentrok dengan Turbo)
    if (window.customerPolling) clearInterval(window.customerPolling);

    // Jalankan pengecekan secara diam-diam ke server setiap 5 detik
    window.customerPolling = setInterval(() => {
        
        // Jangan refresh tabel jika Admin sedang fokus mengetik pencarian/filter
        if (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'SELECT') return;

        // Jangan refresh tabel jika Admin sedang membuka Modal / melihat Detail
        // (Mencegah modal tertutup tiba-tiba)
        if (document.querySelector('dialog[open]') || document.querySelector('.modal-open')) return;

        // Ambil HTML terbaru dari server secara AJAX
        fetch(window.location.href, { headers: { 'Accept': 'text/html' } })
            .then(res => res.text())
            .then(html => {
                // Ekstrak bagian tabel saja dari HTML yang didapat
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.getElementById('realtime-customer-table');
                if (newTable) {
                    document.getElementById('realtime-customer-table').innerHTML = newTable.innerHTML;
                }
            });
    }, 5000);
</script>