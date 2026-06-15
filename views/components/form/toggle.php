<?php
$name = $name ?? '';
$label = $label ?? ucfirst($name);
$checked = $checked ?? false;
$value = $value ?? '1';
$description = $description ?? null;
?>
<label class="flex cursor-pointer items-start gap-3">
    <input
        type="checkbox"
        name="<?= e($name) ?>"
        value="<?= e((string) $value) ?>"
        <?= $checked ? 'checked' : '' ?>
        class="peer sr-only inset-0"
    >
    <span class="relative mt-0.5 block h-6 w-11 shrink-0 rounded-full bg-slate-300 transition after:absolute after:left-1 after:top-1 after:h-4 after:w-4 after:rounded-full after:bg-white after:transition peer-checked:bg-blue-700 peer-checked:after:translate-x-5 peer-focus:ring-2 peer-focus:ring-blue-100"></span>
    <span class="min-w-0 text-sm font-medium leading-snug text-slate-700">
        <?= e($label) ?>
        <?php if ($description): ?>
            <span class="mt-0.5 block text-xs font-normal leading-relaxed text-slate-400"><?= e($description) ?></span>
        <?php endif; ?>
    </span>
</label>
