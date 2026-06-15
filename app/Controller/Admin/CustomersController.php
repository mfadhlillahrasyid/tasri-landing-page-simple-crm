<?php

class CustomersController extends BaseAdminController
{
    public function index(): void
    {
        AuthController::requireAuth();

        $customers = CustomerRepository::all();
        $users = UserRepository::all();
        $userMap = $this->userMap($users);
        $search = strtolower(trim($_GET['search'] ?? ''));
        $category = trim($_GET['category'] ?? '');
        $assignedBy = trim($_GET['assigned_by'] ?? '');

        $filtered = array_filter($customers, function ($customer) use ($search, $category, $assignedBy, $userMap) {
            $assignedUser = $userMap[(int) ($customer['assigned_by'] ?? 0)] ?? null;
            $matchesSearch = $search === ''
                || str_contains(strtolower($customer['name'] ?? ''), $search)
                || str_contains(strtolower($customer['whatsapp'] ?? ''), $search)
                || str_contains(strtolower($customer['city'] ?? ''), $search);
            $matchesCategory = $category === '' || ($customer['lead_category'] ?? '') === $category;
            $matchesAssigned = $assignedBy === ''
                || ($assignedBy === 'none' && empty($customer['assigned_by']))
                || (string) ($assignedUser['slug'] ?? '') === $assignedBy
                || (string) ($customer['assigned_by'] ?? '') === $assignedBy;

            return $matchesSearch && $matchesCategory && $matchesAssigned;
        });

        $pagination = Pagination::make(array_reverse(array_values($filtered)));

        render('admin/customers/index', [
            'title' => 'Customers',
            'customers' => $pagination['items'],
            'pagination' => $pagination['meta'],
            'users' => $users,
            'userMap' => $userMap,
            'leadCategories' => LeadCategories::labels(),
            'leadCategoryOptions' => LeadCategories::primaryLabels(),
            'currentUser' => AuthController::currentUser(),
        ], 'layouts/admin/index');
    }

    public function view(): void
    {
        AuthController::requireAuth();

        $customer = CustomerRepository::find((int) ($_GET['id'] ?? 0));

        if (!$customer) {
            redirect('/admin/customers');
        }

        render('admin/customers/view', [
            'title' => 'View Customer',
            'customer' => $customer,
            'users' => UserRepository::all(),
            'leadCategories' => LeadCategories::labels(),
            'leadCategoryOptions' => LeadCategories::primaryLabels(),
            'error' => flash('error'),
        ], 'layouts/admin/index');
    }

    public function updateCategory(): void
    {
        AuthController::requireAuth();

        $id = (int) ($_POST['id'] ?? 0);
        $leadCategory = $_POST['lead_category'] ?? '';
        $currentUser = AuthController::currentUser();

        if (!in_array($leadCategory, array_keys(LeadCategories::primaryLabels()), true)) {
            $_SESSION['flash']['error'] = 'Kategori lead tidak valid.';
            redirect('/admin/customers');
        }

        $customer = CustomerRepository::find($id);

        if (!$customer) {
            $_SESSION['flash']['error'] = 'Customer tidak ditemukan.';
            redirect('/admin/customers');
        }

        if (!$this->canManageCustomer($customer, $currentUser)) {
            $_SESSION['flash']['error'] = 'Lead ini sudah dimiliki marketing lain dan hanya bisa dilihat.';
            redirect('/admin/customers');
        }

        if (($customer['lead_category'] ?? '') === LeadCategories::CLOSING) {
            $_SESSION['flash']['error'] = 'Customer closing tidak bisa diedit lagi.';
            redirect('/admin/customers');
        }

        $closingImages = [];

        if ($leadCategory === LeadCategories::CLOSING) {
            $closingImages = $this->uploadImages('closing_images', 'closing', 5);

            if ($closingImages === null) {
                redirect('/admin/customers');
            }

            $existingImages = $customer['closing_images'] ?? [];
            $totalImages = count($existingImages) + count($closingImages);

            if ($totalImages > 5) {
                $_SESSION['flash']['error'] = 'Gambar closing maksimal 5.';
                redirect('/admin/customers');
            }
        }

        CustomerRepository::updateCategory($id, $leadCategory, $closingImages);
        redirect('/admin/customers');
    }

    public function uploadClosingImages(): void
    {
        AuthController::requireAuth();

        $id = (int) ($_POST['id'] ?? 0);
        $currentUser = AuthController::currentUser();
        $customer = CustomerRepository::find($id);

        if (!$customer) {
            $_SESSION['flash']['error'] = 'Customer tidak ditemukan.';
            redirect('/admin/customers');
        }

        if (!$this->canManageCustomer($customer, $currentUser)) {
            $_SESSION['flash']['error'] = 'Lead ini sudah dimiliki marketing lain dan hanya bisa dilihat.';
            redirect('/admin/customers');
        }

        if (($customer['lead_category'] ?? '') !== LeadCategories::CLOSING) {
            $_SESSION['flash']['error'] = 'Gambar closing hanya bisa diupload untuk customer closing.';
            redirect('/admin/customers');
        }

        $closingImages = $this->uploadImages('closing_images', 'closing', 5);

        if ($closingImages === null) {
            redirect('/admin/customers');
        }

        if (empty($closingImages)) {
            $_SESSION['flash']['error'] = 'Pilih gambar closing terlebih dahulu.';
            redirect('/admin/customers');
        }

        $existingImages = is_array($customer['closing_images'] ?? null) ? $customer['closing_images'] : [];
        $totalImages = count($existingImages) + count($closingImages);

        if ($totalImages > 5) {
            $_SESSION['flash']['error'] = 'Gambar closing maksimal 5.';
            redirect('/admin/customers');
        }

        CustomerRepository::addClosingImages($id, $closingImages);
        redirect('/admin/customers');
    }

    public function assign(): void
    {
        AuthController::requireAuth();

        $id = (int) ($_POST['id'] ?? 0);
        $currentUser = AuthController::currentUser();
        $assignedBy = (int) ($_POST['assigned_by'] ?? 0);
        $customer = CustomerRepository::find($id);

        if (!$customer) {
            $_SESSION['flash']['error'] = 'Customer tidak ditemukan.';
            redirect('/admin/customers');
        }

        if (($customer['lead_category'] ?? '') === LeadCategories::CLOSING) {
            $_SESSION['flash']['error'] = 'Customer closing tidak bisa diedit lagi.';
            redirect('/admin/customers');
        }

        if (($currentUser['role'] ?? '') === UserRoles::MARKETING) {
            if (!empty($customer['assigned_by'])
                && (int) ($customer['assigned_by'] ?? 0) !== (int) ($currentUser['id'] ?? 0)
            ) {
                $_SESSION['flash']['error'] = 'Customer ini sudah di-assign ke marketing lain.';
                redirect('/admin/customers');
            }

            $assignedBy = (int) ($currentUser['id'] ?? 0);
        }

        if (!UserRepository::isActiveMarketing($assignedBy)) {
            $_SESSION['flash']['error'] = 'Customer hanya bisa di-assign ke user marketing aktif.';
            redirect('/admin/customers');
        }

        CustomerRepository::assign($id, $assignedBy);
        redirect('/admin/customers');
    }

    public function delete(): void
    {
        AuthController::requireAdmin();

        $id = (int) ($_POST['id'] ?? 0);
        CustomerRepository::delete($id);
        redirect('/admin/customers');
    }

    private function canManageCustomer(?array $customer, ?array $currentUser): bool
    {
        if (!$customer || !$currentUser) {
            return false;
        }

        if (($currentUser['role'] ?? '') === UserRoles::ADMIN) {
            return true;
        }

        if (($currentUser['role'] ?? '') !== UserRoles::MARKETING) {
            return false;
        }

        return !empty($customer['assigned_by'])
            && (int) ($customer['assigned_by'] ?? 0) === (int) ($currentUser['id'] ?? 0);
    }
}
