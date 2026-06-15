<h1 class="truncate text-xl tracking-tight font-medium sm:text-2xl mb-4">
    <?= e($title ?? 'Dashboard') ?>
</h1>

<section class="rounded-xl border border-slate-200 bg-white p-5">
    <?php if (!empty($error)): ?>
        <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700"><?= e($error) ?></div>
    <?php endif; ?>

    <form class="space-y-4" method="post" action="<?= e(url('/admin/users/store')) ?>" enctype="multipart/form-data">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <?php component('form/input', ['name' => 'name', 'label' => 'Nama Lengkap', 'required' => true, 'placeholder' => 'Masukkan Nama']); ?>
        <?php component('form/input', ['name' => 'whatsapp', 'label' => 'WhatsApp', 'placeholder' => 'Whatsapp Aktif']); ?>
        </div>

        <?php component('form/select', ['name' => 'role', 'label' => 'Role', 'options' => $roles, 'selected' => UserRoles::MARKETING, 'required' => true, 'custom' => true]); ?>
        <?php component('form/dropzone', ['name' => 'avatar', 'label' => 'Foto User', 'maxFiles' => 1, 'maxSize' => 2, 'initials' => initials('User')]); ?>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <?php component('form/password', ['name' => 'password', 'label' => 'Password', 'required' => true, 'placeholder' => 'Masukkan Password Baru']); ?>
            <?php component('form/password', ['name' => 'retype_password', 'label' => 'Retype Password', 'required' => true, 'placeholder' => 'Konfirmasi Password']); ?>
        </div>
        
        <?php component('form/toggle', ['name' => 'status', 'label' => 'Active', 'checked' => true]); ?>
        
        <div class="flex gap-3">
            <?php component('button', ['label' => 'Create User']); ?>
            <?php component('button', [
                'as' => 'a',
                'href' => url('/admin/users'),
                'label' => 'Cancel',
                'class' => 'border border-slate-300 bg-white text-slate-700 hover:bg-slate-50',
            ]); ?>
        </div>
    </form>
</section>
