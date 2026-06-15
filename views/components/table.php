<?php
$title = $title ?? null;
$headers = $headers ?? [];
$rows = $rows ?? [];
$emptyMessage = $emptyMessage ?? 'Belum ada data.';
$class = $class ?? '';
$tableClass = $tableClass ?? '';
$colspan = max(1, count($headers));
?>
<div class="overflow-x-auto rounded-xl border border-slate-200 bg-white <?= e($class) ?>">
    <?php if ($title): ?>
        <h2 class="border-b border-slate-200 p-4 text-base font-medium text-slate-500"><?= e($title) ?></h2>
    <?php endif; ?>

    <table class="table whitespace-nowrap <?= e($tableClass) ?>">
        <?php if (!empty($headers)): ?>
            <thead class="bg-slate-50 text-slate-500 text-left text-sm">
                <tr>
                    <?php foreach ($headers as $header): ?>
                        <th><?= e((string) $header) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
        <?php endif; ?>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr class="text-xs sm:text-sm text-slate-500 capitalize">
                    <?php foreach ($row as $cell): ?>
                        <?php
                        $cell = is_array($cell) ? $cell : ['text' => $cell];
                        $tag = !empty($cell['header']) ? 'th' : 'td';
                        $cellClass = $cell['class'] ?? '';
                        $content = array_key_exists('html', $cell)
                            ? (string) $cell['html']
                            : e((string) ($cell['text'] ?? ''));
                        ?>
                        <<?= $tag ?> class="<?= e($cellClass) ?>"><?= $content ?></<?= $tag ?>>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>

            <?php if (empty($rows)): ?>
                <tr>
                    <td colspan="<?= e((string) $colspan) ?>" class="text-slate-500 text-center py-10"><?= e($emptyMessage) ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
