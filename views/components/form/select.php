<?php
$name = $name ?? '';
$label = $label ?? ucfirst($name);
$options = $options ?? [];
$selected = (string) ($selected ?? '');
$required = $required ?? false;
$custom = $custom ?? false;
$selectedLabel = '';

foreach ($options as $value => $text) {
    if ((string) $value === $selected) {
        $selectedLabel = (string) $text;
        break;
    }
}

$selectedLabel = $selectedLabel !== '' ? $selectedLabel : 'Pilih ' . $label;
?>
<?php if ($custom): ?>
    <label class="block">
        <span class="mb-2 block text-sm font-medium text-slate-700"><?= e($label) ?></span>
        <div class="relative" data-custom-select>
            <select name="<?= e($name) ?>" <?= $required ? 'required' : '' ?> class="sr-only" data-custom-select-native>
                <?php foreach ($options as $value => $text): ?>
                    <?php $isSelected = (string) $value === $selected; ?>
                    <option value="<?= e((string) $value) ?>" <?= $isSelected ? 'selected' : '' ?>>
                        <?= e((string) $text) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="button"
                class="flex w-full cursor-pointer items-center justify-between rounded-lg border border-slate-300 bg-slate-100 px-2.5 py-1.5 text-left text-xs sm:text-sm outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-100"
                data-custom-select-trigger aria-haspopup="listbox" aria-expanded="false">
                <span data-custom-select-label><?= e($selectedLabel) ?></span>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3 text-slate-400 transition-transform duration-200"
                    data-custom-select-icon>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>

            </button>

            <div class="absolute left-0 right-0 top-full z-30 mt-1 hidden overflow-hidden rounded-lg border border-slate-200 bg-white py-1 shadow-lg"
                data-custom-select-menu role="listbox">
                <?php foreach ($options as $value => $text): ?>
                    <?php $isSelected = (string) $value === $selected; ?>
                    <button type="button"
                        class="block w-full px-2.5 py-1.5 text-left text-xs sm:text-sm hover:bg-blue-50 <?= $isSelected ? 'bg-blue-50 text-blue-700' : 'text-slate-700' ?>"
                        data-custom-select-option data-value="<?= e((string) $value) ?>"
                        data-selected="<?= $isSelected ? 'true' : 'false' ?>" role="option"
                        aria-selected="<?= $isSelected ? 'true' : 'false' ?>">
                        <?= e((string) $text) ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </label>
<?php else: ?>
    <label class="block">
        <span class="mb-2 block text-sm font-medium text-slate-700"><?= e($label) ?></span>
        <select name="<?= e($name) ?>" <?= $required ? 'required' : '' ?>
            class="w-full rounded-lg border border-slate-300 bg-slate-100 px-2.5 py-1.5 text-sm outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-100">
            <?php foreach ($options as $value => $text): ?>
                <?php $isSelected = (string) $value === $selected; ?>
                <option value="<?= e((string) $value) ?>" <?= $isSelected ? 'selected' : '' ?>>
                    <?= e((string) $text) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
<?php endif; ?>
