<?php

class SettingsController extends BaseAdminController
{
    public function index(): void
    {
        AuthController::requireAdmin();

        render('admin/settings/index', [
            'title' => 'Settings',
            'autoAssignRotatedLead' => SettingRepository::bool(SettingRepository::AUTO_ASSIGN_ROTATED_LEAD),
            'success' => flash('success'),
            'error' => flash('error'),
        ], 'layouts/admin/index');
    }

    public function update(): void
    {
        AuthController::requireAdmin();

        SettingRepository::setBool(
            SettingRepository::AUTO_ASSIGN_ROTATED_LEAD,
            isset($_POST['auto_assign_rotated_lead'])
        );

        $this->logActivity('update_settings', 'Memperbarui pengaturan aplikasi');
        $_SESSION['flash']['success'] = 'Settings berhasil disimpan.';
        redirect('/admin/settings');
    }
}
