<?php
$pagination = $pagination ?? null;
?>
<?php if ($pagination && ($pagination['total_pages'] ?? 1) > 1): ?>
    <nav class="mt-4 flex items-center justify-between gap-3 text-sm">
        <p class="text-slate-500">
            Page <?= e((string) $pagination['current_page']) ?> of <?= e((string) $pagination['total_pages']) ?>
        </p>
        <div class="flex gap-2">
            <?php if (!empty($pagination['prev_url'])): ?>
                <?php component('button', [
                    'as' => 'a',
                    'href' => $pagination['prev_url'],
                    'label' => 'Prev',
                    'class' => 'border border-slate-300 bg-white px-3 py-1.5 text-slate-700 hover:bg-slate-50',
                ]); ?>
            <?php endif; ?>
            <?php if (!empty($pagination['next_url'])): ?>
                <?php component('button', [
                    'as' => 'a',
                    'href' => $pagination['next_url'],
                    'label' => 'Next',
                    'class' => 'border border-slate-300 bg-white px-3 py-1.5 text-slate-700 hover:bg-slate-50',
                ]); ?>
            <?php endif; ?>
        </div>
    </nav>
<?php endif; ?>
