<?php
$name = $name ?? 'images';
$label = $label ?? 'Upload Image';
$multiple = $multiple ?? false;
$maxFiles = (int) ($maxFiles ?? ($multiple ? 5 : 1));
$maxSize = (int) ($maxSize ?? 2);
$accept = $accept ?? 'image/*';
$existing = $existing ?? [];
$initials = $initials ?? null;
$showWhenName = $showWhenName ?? null;
$showWhenValue = $showWhenValue ?? null;
$inputName = $multiple && !str_ends_with($name, '[]') ? $name . '[]' : $name;
?>
<label
    class="block"
    data-dropzone
    data-dropzone-max-files="<?= e((string) $maxFiles) ?>"
    data-dropzone-max-size="<?= e((string) ($maxSize * 1024 * 1024)) ?>"
    <?= $showWhenName ? 'data-dropzone-when-name="' . e($showWhenName) . '"' : '' ?>
    <?= $showWhenValue ? 'data-dropzone-when-value="' . e($showWhenValue) . '"' : '' ?>
>
    <span class="mb-2 block text-sm font-medium text-slate-700"><?= e($label) ?></span>
    <span class="flex min-h-28 cursor-pointer flex-col items-center justify-center rounded-lg border border-dashed border-slate-300 bg-slate-100 px-3 py-4 text-center transition hover:border-blue-400 hover:bg-blue-50">
        <input
            type="file"
            name="<?= e($inputName) ?>"
            accept="<?= e($accept) ?>"
            <?= $multiple ? 'multiple' : '' ?>
            class="sr-only"
            data-dropzone-input
        >
        <span class="text-sm font-medium text-slate-700">Klik untuk upload gambar</span>
        <span class="mt-1 text-xs text-slate-400">
            Maks <?= e((string) $maxFiles) ?> file, <?= e((string) $maxSize) ?>MB/file
        </span>
    </span>
    <div class="mt-3 flex flex-wrap gap-2" data-dropzone-preview>
        <?php foreach ($existing as $image): ?>
            <img src="<?= e(url($image)) ?>" alt="Uploaded image" class="h-16 w-16 rounded-lg object-cover">
        <?php endforeach; ?>
        <?php if (empty($existing) && $initials): ?>
            <span class="inline-flex h-16 w-16 items-center justify-center rounded-lg bg-slate-100 text-sm font-semibold text-slate-600">
                <?= e($initials) ?>
            </span>
        <?php endif; ?>
    </div>
    <p class="mt-2 hidden text-xs text-red-600" data-dropzone-error></p>
</label>
