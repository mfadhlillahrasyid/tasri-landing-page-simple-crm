<?php

class UsersController extends BaseAdminController
{
    public function index(): void
    {
        AuthController::requireAuth();

        render('admin/users/index', [
            'title' => 'Users',
            'users' => UserRepository::all(),
            'roleLabels' => UserRoles::labels(),
            'currentUser' => AuthController::currentUser(),
        ], 'layouts/admin/index');
    }

    public function create(): void
    {
        AuthController::requireAdmin();

        render('admin/users/create', [
            'title' => 'Create User',
            'roles' => UserRoles::labels(),
            'error' => flash('error'),
        ], 'layouts/admin/index');
    }

    public function store(): void
    {
        AuthController::requireAdmin();

        $payload = $this->userPayload();

        if (!$payload) {
            redirect('/admin/users/create');
        }

        $now = app_now();
        $payload['slug'] = app_slug($payload['name']);
        $payload['created_at'] = $now;
        $payload['updated_at'] = $now;

        UserRepository::create($payload);
        $this->logActivity('create_user', 'Mendaftarkan user baru: ' . $payload['name']);
        redirect('/admin/users');
    }

    public function edit(): void
    {
        AuthController::requireAuth();

        $user = UserRepository::find((int) ($_GET['id'] ?? 0));
        $currentUser = AuthController::currentUser();
        $canEdit = ($currentUser['role'] ?? '') === UserRoles::ADMIN
            || (int) ($currentUser['id'] ?? 0) === (int) ($user['id'] ?? 0);

        if (!$user || !$canEdit || ($user['role'] ?? '') === UserRoles::ADMIN) {
            $_SESSION['flash']['error'] = 'User admin tidak dapat diedit dari halaman ini.';
            redirect('/admin/users');
        }

        render('admin/users/edit', [
            'title' => 'Edit User',
            'user' => $user,
            'currentUser' => $currentUser,
            'roles' => UserRoles::labels(),
            'error' => flash('error'),
        ], 'layouts/admin/index');
    }

    public function update(): void
    {
        AuthController::requireAuth();

        $id = (int) ($_POST['id'] ?? 0);
        $existing = UserRepository::find($id);
        $currentUser = AuthController::currentUser();
        $canEdit = ($currentUser['role'] ?? '') === UserRoles::ADMIN
            || (int) ($currentUser['id'] ?? 0) === $id;

        if (!$existing || !$canEdit || ($existing['role'] ?? '') === UserRoles::ADMIN) {
            $_SESSION['flash']['error'] = 'User admin tidak dapat diedit.';
            redirect('/admin/users');
        }

        if (!$this->validatePasswordChange($existing, $currentUser)) {
            redirect('/admin/users/edit?id=' . $id);
        }

        $payload = $this->userPayload($existing);

        if (!$payload) {
            redirect('/admin/users/edit?id=' . $id);
        }

        if (($currentUser['role'] ?? '') !== UserRoles::ADMIN) {
            $payload['role'] = $existing['role'] ?? UserRoles::MARKETING;
        }

        $payload = array_merge($existing, $payload, [
            'slug' => app_slug($payload['name']),
            'updated_at' => app_now(),
        ]);

        UserRepository::update($id, $payload);
        $this->logActivity('update_user', 'Memperbarui data user: ' . ($existing['name'] ?? ''), $id);
        redirect('/admin/users');
    }

    public function delete(): void
    {
        AuthController::requireAdmin();

        $id = (int) ($_POST['id'] ?? 0);
        $currentUserId = (int) (AuthController::currentUser()['id'] ?? 0);
        $target = UserRepository::find($id);

        if ($id === $currentUserId || !$target || ($target['role'] ?? '') !== UserRoles::MARKETING) {
            $_SESSION['flash']['error'] = 'Hanya user marketing yang dapat dihapus, dan admin tidak dapat menghapus dirinya sendiri.';
            redirect('/admin/users');
        }

        UserRepository::deleteMarketing($id);
        $this->logActivity('delete_user', 'Menghapus user marketing: ' . ($target['name'] ?? ''), $id);
        redirect('/admin/users');
    }

    private function userPayload(?array $existing = null): ?array
    {
        $name = trim($_POST['name'] ?? '');
        $role = $_POST['role'] ?? '';
        $whatsapp = preg_replace('/\D+/', '', $_POST['whatsapp'] ?? '');
        $status = isset($_POST['status']);
        $password = (string) ($_POST['password'] ?? '');
        $retypePassword = (string) ($_POST['retype_password'] ?? '');

        if ($name === '' || !in_array($role, UserRoles::all(), true) || ($role === UserRoles::MARKETING && $whatsapp === '')) {
            $_SESSION['flash']['error'] = 'Nama, role, dan WhatsApp marketing wajib valid.';
            return null;
        }

        if ($existing === null && $password === '') {
            $_SESSION['flash']['error'] = 'Password wajib diisi.';
            return null;
        }

        if ($existing === null && $password !== $retypePassword) {
            $_SESSION['flash']['error'] = 'Retype password tidak sama dengan password.';
            return null;
        }

        if (str_starts_with($whatsapp, '0')) {
            $whatsapp = '62' . substr($whatsapp, 1);
        }

        $avatarUploads = $this->uploadImages('avatar', 'users', 1);

        if ($avatarUploads === null) {
            return null;
        }

        return [
            'name' => $name,
            'role' => $role,
            'whatsapp' => $whatsapp,
            'status' => $status,
            'password' => $password !== '' ? password_hash($password, PASSWORD_DEFAULT) : (string) ($existing['password'] ?? ''),
            'avatar' => $avatarUploads[0] ?? (string) ($existing['avatar'] ?? ''),
        ];
    }

    private function validatePasswordChange(array $existing, array $currentUser): bool
    {
        $password = (string) ($_POST['password'] ?? '');
        $retypePassword = (string) ($_POST['retype_password'] ?? '');
        $currentPassword = (string) ($_POST['current_password'] ?? '');
        $wantsPasswordChange = $password !== '' || $retypePassword !== '' || $currentPassword !== '';

        if (!$wantsPasswordChange) {
            return true;
        }

        if ($password === '' || $retypePassword === '') {
            $_SESSION['flash']['error'] = 'Password baru dan retype password wajib diisi.';
            return false;
        }

        if ($password !== $retypePassword) {
            $_SESSION['flash']['error'] = 'Retype password tidak sama dengan password baru.';
            return false;
        }

        $isCurrentUser = (int) ($currentUser['id'] ?? 0) === (int) ($existing['id'] ?? 0);
        $isMarketing = ($currentUser['role'] ?? '') === UserRoles::MARKETING;

        if ($isCurrentUser && $isMarketing) {
            if ($currentPassword === '') {
                $_SESSION['flash']['error'] = 'Password lama wajib diisi.';
                return false;
            }

            if (!password_verify($currentPassword, (string) ($existing['password'] ?? ''))) {
                $_SESSION['flash']['error'] = 'Password lama tidak sesuai.';
                return false;
            }
        }

        return true;
    }
}
