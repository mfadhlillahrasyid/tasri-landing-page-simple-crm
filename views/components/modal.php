<?php
$type = $type ?? 'dialog';
?>
<?php if ($type === 'confirm'): ?>
    <div id="confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center px-4" aria-hidden="true">
        <div class="absolute inset-0 bg-slate-950/50" data-modal-cancel></div>
        <div class="relative w-full max-w-sm rounded-xl bg-white p-5 shadow-xl text-center">
            <h2 id="confirm-modal-title" class="text-lg sm:text-xl font-medium text-slate-900">Konfirmasi Aksi</h2>
            <p id="confirm-modal-message" class="mt-2 text-sm text-slate-600">Lanjutkan aksi ini?</p>

            <div class="mt-5 grid grid-cols-2 gap-3">
                <?php component('button', [
                    'type' => 'button',
                    'label' => 'Batal',
                    'class' => 'border border-slate-300 text-slate-700 hover:bg-slate-100 hover:border-slate-300',
                    'attributes' => ['data-modal-cancel' => true],
                ]); ?>
                <?php component('button', [
                    'type' => 'button',
                    'label' => 'Lanjutkan',
                    'class' => 'bg-red-600 text-white hover:bg-red-700',
                    'attributes' => ['data-modal-confirm' => true],
                ]); ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php
    $id = $id ?? '';
    $title = $title ?? null;
    $content = $content ?? '';
    $class = $class ?? '';
    ?>
    <dialog id="<?= e($id) ?>" class="modal">
        <div class="modal-box rounded-xl bg-white <?= e($class) ?>">
            <form method="dialog">
                <button
                    class="absolute right-4 top-4 rounded-lg flex items-center justify-center cursor-pointer w-8 h-8 text-slate-400 bg-slate-100 hover:bg-slate-200 hover:text-slate-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>
            </form>

            <?php if ($title): ?>
                <h2 class="text-lg sm:text-xl font-semibold text-slate-900"><?= e($title) ?></h2>
            <?php endif; ?>

            <?= $content ?>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
<?php endif; ?>