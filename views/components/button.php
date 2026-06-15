<?php
$as = $as ?? $tag ?? 'button';
$type = $type ?? 'submit';
$label = $label ?? 'Simpan';
$href = $href ?? '#';
$target = $target ?? null;
$rel = $rel ?? null;
$class = $class ?? 'bg-blue-700 text-white hover:bg-blue-800';
$baseClass = 'inline-flex cursor-pointer items-center justify-center rounded-lg px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-300';
$attributes = $attributes ?? [];
$dataAttributes = $dataAttributes ?? $dataAttrs ?? [];

if (empty($dataAttributes) && isset($data['data']) && is_array($data['data'])) {
    $dataAttributes = $data['data'];
}

$attributeHtml = '';

foreach ($dataAttributes as $key => $value) {
    if ($value === false || $value === null) {
        continue;
    }

    $attributeHtml .= ' data-' . e((string) $key);

    if ($value !== true) {
        $attributeHtml .= '="' . e((string) $value) . '"';
    }
}

foreach ($attributes as $key => $value) {
    if ($value === false || $value === null) {
        continue;
    }

    $attributeHtml .= ' ' . e((string) $key);

    if ($value !== true) {
        $attributeHtml .= '="' . e((string) $value) . '"';
    }
}
?>
<?php if ($as === 'a'): ?>
    <a
        href="<?= e($href) ?>"
        class="<?= e($baseClass . ' ' . $class) ?>"
        <?= $target ? 'target="' . e($target) . '"' : '' ?>
        <?= $rel ? 'rel="' . e($rel) . '"' : '' ?>
        <?= $attributeHtml ?>
    >
        <?= e($label) ?>
    </a>
<?php else: ?>
    <button type="<?= e($type) ?>" class="<?= e($baseClass . ' ' . $class) ?>"<?= $attributeHtml ?>>
        <?= e($label) ?>
    </button>
<?php endif; ?>
