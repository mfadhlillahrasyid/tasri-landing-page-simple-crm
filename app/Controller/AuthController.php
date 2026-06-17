<?php

class AuthController
{
    public function loginForm(): void
    {
        render('admin/login', [
            'error' => flash('error'),
        ]);
    }

    public function login(): void
    {
        $whatsappInput = trim($_POST['whatsapp'] ?? '');
        $password = (string) ($_POST['password'] ?? '');
        $users = UserRepository::all();

        foreach ($users as $user) {
            $whatsapp = (string) ($user['whatsapp'] ?? '');

            if ($this->normalizeWhatsapp($whatsapp) === $this->normalizeWhatsapp($whatsappInput)
                && (bool) ($user['status'] ?? false)
                && $this->passwordMatches($password, (string) ($user['password'] ?? ''))
            ) {
                $_SESSION['auth_user_id'] = (int) $user['id'];
                $_SESSION['admin_user_id'] = (int) $user['id'];
                
                if (class_exists('LogRepository')) {
                    LogRepository::create([
                        'user_id' => (int) $user['id'],
                        'action' => 'login',
                        'description' => 'User berhasil login ke dalam sistem.',
                        'target_id' => null,
                        'created_at' => function_exists('app_now') ? app_now() : date('Y-m-d H:i:s'),
                    ]);
                }
                
                redirect('/admin/dashboard');
            }
        }

        $_SESSION['flash']['error'] = 'Login gagal. Periksa WhatsApp dan password.';
        redirect('/login');
    }

    public function logout(): void
    {
        $userId = (int) ($_SESSION['auth_user_id'] ?? $_SESSION['admin_user_id'] ?? 0);
        if ($userId > 0 && class_exists('LogRepository')) {
            LogRepository::create([
                'user_id' => $userId,
                'action' => 'logout',
                'description' => 'User logout dari sistem.',
                'target_id' => null,
                'created_at' => function_exists('app_now') ? app_now() : date('Y-m-d H:i:s'),
            ]);
        }

        unset($_SESSION['auth_user_id']);
        unset($_SESSION['admin_user_id']);
        redirect('/login');
    }

    private function passwordMatches(string $input, string $stored): bool
    {
        if ($stored === '') {
            return false;
        }

        return hash_equals($stored, $input);
    }

    private function normalizeWhatsapp(string $number): string
    {
        $digits = preg_replace('/\D+/', '', $number);

        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        return $digits;
    }

    public static function requireAdmin(): void
    {
        $user = self::currentUser();

        if (!$user || ($user['role'] ?? '') !== UserRoles::ADMIN) {
            redirect('/login');
        }
    }

    public static function requireAuth(): void
    {
        if (!self::currentUser()) {
            redirect('/login');
        }
    }

    public static function currentUser(): ?array
    {
        $userId = (int) ($_SESSION['auth_user_id'] ?? $_SESSION['admin_user_id'] ?? 0);

        if ($userId === 0) {
            return null;
        }

        $user = UserRepository::find($userId);

        if ($user && (bool) ($user['status'] ?? false)) {
            return $user;
        }

        unset($_SESSION['auth_user_id']);
        unset($_SESSION['admin_user_id']);

        return null;
    }
}
