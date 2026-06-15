<?php

class LandingController
{
    public function home(): void
    {
        render('landing/home', [
            'error' => flash('error'),
        ]);

        unset($_SESSION['old']);
    }

    public function submitLead(): void
    {
        $fullname = trim($_POST['fullname'] ?? '');
        $whatsapp = trim($_POST['whatsapp'] ?? '');
        $city = trim($_POST['city'] ?? '');

        if ($fullname === '' || $whatsapp === '' || $city === '') {
            $_SESSION['old'] = compact('fullname', 'whatsapp', 'city');
            $_SESSION['flash']['error'] = 'Nama, WhatsApp, dan kota wajib diisi.';
            redirect('/#lead-form');
        }

        $marketing = $this->nextMarketing();
        $now = app_now();

        $customer = [
            'name' => $fullname,
            'whatsapp' => $this->normalizeWhatsapp($whatsapp),
            'city' => $city,
            'slug' => app_slug($fullname) . '-' . time(),
            'assigned_by' => $this->shouldAutoAssignRotatedLead() ? ($marketing['id'] ?? null) : null,
            'lead_category' => LeadCategories::COLD,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        CustomerRepository::create($customer);

        if ($marketing !== null) {
            $this->advanceRotator();
        }

        $targetWhatsapp = $marketing['whatsapp'] ?? Config::FALLBACK_WHATSAPP;
        $message = "Halo, tertarik dengan Rumah Bebas Desain dari TASRI.\n\n"
            . "Nama: {$fullname}\n"
            . "WhatsApp: {$customer['whatsapp']}\n"
            . "Kota: {$city}\n\n"
            . "Saya ingin dibantu informasi cluster dan desain rumah yang cocok.";

        header('Location: https://wa.me/' . $this->normalizeWhatsapp($targetWhatsapp) . '?text=' . rawurlencode($message));
        exit;
    }

    private function nextMarketing(): ?array
    {
        $marketings = UserRepository::activeMarketings();

        if (empty($marketings)) {
            return null;
        }

        $index = ((int) SettingRepository::get(SettingRepository::MARKETING_LAST_INDEX, '0')) % count($marketings);

        return $marketings[$index];
    }

    private function advanceRotator(): void
    {
        $marketings = UserRepository::activeMarketings();

        if (empty($marketings)) {
            return;
        }

        $nextIndex = (((int) SettingRepository::get(SettingRepository::MARKETING_LAST_INDEX, '0')) + 1) % count($marketings);
        SettingRepository::set(SettingRepository::MARKETING_LAST_INDEX, (string) $nextIndex);
    }

    private function shouldAutoAssignRotatedLead(): bool
    {
        return SettingRepository::bool(SettingRepository::AUTO_ASSIGN_ROTATED_LEAD);
    }

    private function normalizeWhatsapp(string $number): string
    {
        $digits = preg_replace('/\D+/', '', $number);

        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        return $digits;
    }
}
