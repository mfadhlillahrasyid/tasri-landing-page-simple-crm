<?php

class DashboardController extends BaseAdminController
{
    public function index(): void
    {
        AuthController::requireAuth();

        $customers = CustomerRepository::all();
        $summary = array_fill_keys(array_keys(LeadCategories::primaryLabels()), 0);

        foreach ($customers as $customer) {
            $category = $customer['lead_category'] ?? LeadCategories::COLD;
            if (isset($summary[$category])) {
                $summary[$category]++;
            }
        }

        $unassignedCustomers = array_values(array_filter($customers, static fn ($customer) => empty($customer['assigned_by'])));

        $pagination = Pagination::make(array_reverse($unassignedCustomers));

        render('admin/dashboard', [
            'title' => 'Dashboard',
            'customers' => $pagination['items'],
            'pagination' => $pagination['meta'],
            'summary' => $summary,
            'totalCustomers' => count($customers),
        ], 'layouts/admin/index');
    }
}
