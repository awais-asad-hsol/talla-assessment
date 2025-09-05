<?php

namespace App\Filament\Employee\Pages;

use App\Models\Country;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;

class CountryManagement extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationLabel = 'Country Management';
    protected static string $view = 'filament.employee.pages.country-management';

    public array $apiCountries = [];
    public array $addedCountries = [];
    public string $search = '';

    public function mount(): void
    {
        // Load saved countries from the separate DB
        $this->loadAddedCountries();
    }

    public function loadAddedCountries(): void
    {
        $this->addedCountries = Country::on('countries_db')->get()->toArray();
    }

    public function fetchCountries(): void
    {
        $url = $this->search
            ? "https://restcountries.com/v3.1/name/{$this->search}?fields=area,capital,currencies,languages,name"
            : "https://restcountries.com/v3.1/all?fields=area,capital,currencies,languages,name";

        $response = Http::get($url);

        if ($response->successful()) {
            $this->apiCountries = $response->json();
        }
    }

    public function addCountry($country): void
    {
        Country::on('countries_db')->firstOrCreate(
            [
                'name' => $country['name']['common'] ?? 'Unknown',
            ],
            [
                'capital' => $country['capital'][0] ?? null,
                'area' => $country['area'] ?? null,
                'currencies' => $country['currencies'] ?? null,
                'languages' => $country['languages'] ?? null,
            ]
        );

        $this->loadAddedCountries();

        $this->dispatch('notify', type: 'success', message: 'Country added successfully!');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true; // Always show in sidebar
    }
}
