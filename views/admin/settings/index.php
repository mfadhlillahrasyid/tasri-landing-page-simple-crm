<h1 class="truncate text-xl tracking-tight font-medium sm:text-2xl mb-4">
    <?= e($title ?? 'Settings') ?>
</h1>

<?php if (!empty($success)): ?>
    <div class="mb-5 rounded-md border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm text-emerald-700">
        <?= e($success) ?>
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="mb-5 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
        <?= e($error) ?>
    </div>
<?php endif; ?>

<section class="rounded-xl border border-slate-200 bg-white p-5">
    <form class="space-y-5" method="post" action="<?= e(url('/admin/settings/update')) ?>">
        <div>
            <h2 class="text-base font-semibold text-slate-900">Lead Rotator</h2>
            <p class="mt-1 max-w-2xl text-xs sm:text-sm leading-relaxed text-slate-500">
                Atur apakah lead dari landing page otomatis menjadi milik marketing yang menerima WhatsApp dari rotator.
            </p>
        </div>

        <?php component('form/toggle', [
            'name' => 'auto_assign_rotated_lead',
            'label' => 'Auto assign Rotator',
            'checked' => !empty($autoAssignRotatedLead),
            'description' => 'Jika off, buyer tetap diarahkan ke WhatsApp marketing rotator, tapi lead masuk sebagai Belum assigned.',
        ]); ?>

        <div>
            <?php component('button', ['label' => 'Simpan Settings', 'class' => 'bg-blue-700 px-4 py-2 text-white hover:bg-blue-800']); ?>
        </div>
    </form>
</section>
