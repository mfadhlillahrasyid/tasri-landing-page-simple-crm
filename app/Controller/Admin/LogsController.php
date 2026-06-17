<?php

class LogsController extends BaseAdminController
{
    public function index(): void
    {
        AuthController::requireAuth();

        $logs = class_exists('LogRepository') ? LogRepository::all() : [];
        $users = UserRepository::all();
        $userMap = $this->userMap($users);
        
        $pagination = Pagination::make(array_values($logs)); // Asumsi sudah urut DESC dari Repository

        render('admin/logs/index', [
            'title' => 'Log History',
            'logs' => $pagination['items'],
            'pagination' => $pagination['meta'],
            'userMap' => $userMap,
        ], 'layouts/admin/index');
    }
}