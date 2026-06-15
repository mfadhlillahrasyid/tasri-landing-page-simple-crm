<?php
$name = $name ?? '';
$label = $label ?? ucfirst($name);
$checked = $checked ?? false;
$class = $class ?? ' checkbox-sm';
?>
<label class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
    <input
        type="checkbox"
        name="<?= e($name) ?>"
        value="1"
        <?= $checked ? 'checked' : '' ?>
        class="checkbox rounded-md cursor-pointer <?= e($class) ?>"
    >
    <?= e($label) ?>
</label>
