<x-filament-panels::page>
    <div 
        x-data="{ showApi: true, showAdded: true }" 
        class="space-y-6">
        
        <div class="flex items-center gap-2">
            <input 
                type="text" 
                wire:model="search" 
                placeholder="Search country..." 
                class="border rounded px-3 py-2 w-1/2
                       text-gray-900 placeholder-gray-500 bg-white 
                       dark:text-gray-100 dark:placeholder-gray-400 dark:bg-gray-800"
            >
            <x-filament::button wire:click="fetchCountries">
                Search
            </x-filament::button>
        </div>
        
        

        <div>
            <button 
                @click="showApi = !showApi" 
                class="font-bold text-lg text-primary-600"
            >
                Fetched Countries (API)
            </button>
            <div x-show="showApi" class="mt-3">
                @if ($apiCountries)
                    <table class="table-auto w-full border">
                        <thead>
                            <tr>
                                <th class="border px-2 py-1">Name</th>
                                <th class="border px-2 py-1">Capital</th>
                                <th class="border px-2 py-1">Area</th>
                                <th class="border px-2 py-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apiCountries as $country)
                                <tr>
                                    <td class="border px-2 py-1">{{ $country['name']['common'] ?? '' }}</td>
                                    <td class="border px-2 py-1">{{ $country['capital'][0] ?? '-' }}</td>
                                    <td class="border px-2 py-1">{{ $country['area'] ?? '-' }}</td>
                                    <td class="border px-2 py-1">
                                        <x-filament::button 
                                            color="success" 
                                            size="sm" 
                                            wire:click="addCountry({{ json_encode($country) }})"
                                        >
                                            Add
                                        </x-filament::button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500 mt-2">No countries loaded yet. Search to fetch data.</p>
                @endif
            </div>
        </div>

        <div>
            <button 
                @click="showAdded = !showAdded" 
                class="font-bold text-lg text-primary-600"
            >
                Added Countries (Database)
            </button>
            <div x-show="showAdded" class="mt-3">
                @if ($addedCountries)
                    <table class="table-auto w-full border">
                        <thead>
                            <tr>
                                <th class="border px-2 py-1">Name</th>
                                <th class="border px-2 py-1">Capital</th>
                                <th class="border px-2 py-1">Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addedCountries as $country)
                                <tr>
                                    <td class="border px-2 py-1">{{ $country['name'] }}</td>
                                    <td class="border px-2 py-1">{{ $country['capital'] ?? '-' }}</td>
                                    <td class="border px-2 py-1">{{ $country['area'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500 mt-2">No countries added yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
