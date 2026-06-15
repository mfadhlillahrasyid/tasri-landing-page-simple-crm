<?php
$name = $name ?? 'password';
$label = $label ?? 'Password';
$placeholder = $placeholder ?? '';
$required = $required ?? false;
?>
<label class="block" data-password-field>
    <span class="mb-2 block text-sm font-medium text-slate-700"><?= e($label) ?></span>
    <div class="relative">
        <input
            type="password"
            name="<?= e($name) ?>"
            value=""
            placeholder="<?= e($placeholder) ?>"
            <?= $required ? 'required' : '' ?>
            data-password-input
            class="w-full rounded-lg bg-slate-100 border border-slate-300 py-1.5 pl-2.5 pr-12 text-sm outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-100 placeholder:text-slate-400 placeholder:text-xs"
        >
        <button
            type="button"
            class="absolute inset-y-1 right-1 flex w-7 cursor-pointer items-center justify-center rounded-md text-sm hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-100"
            data-password-toggle
            aria-label="Tampilkan password"
            aria-pressed="false"
        >👁️</button>
    </div>
</label>
