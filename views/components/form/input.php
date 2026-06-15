<?php
$type = $type ?? 'text';
$name = $name ?? '';
$label = $label ?? ucfirst($name);
$value = $value ?? '';
$required = $required ?? false;
$placeholder = $placeholder ?? '';
?>
<label class="block">
    <span class="mb-2 block text-sm font-medium text-slate-700"><?= e($label) ?></span>
    <input
        type="<?= e($type) ?>"
        name="<?= e($name) ?>"
        value="<?= e($value) ?>"
        placeholder="<?= e($placeholder) ?>"
        <?= $required ? 'required' : '' ?>
        class="w-full rounded-lg bg-slate-100 border border-slate-300 px-2.5 py-1.5 text-xs sm:text-sm outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-100 placeholder:text-slate-400 placeholder:text-xs"
    >
</label>
