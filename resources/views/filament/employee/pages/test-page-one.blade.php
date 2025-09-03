<x-filament-panels::page>
    <h2 class="text-lg font-bold mb-4">Test Page 1</h2>

    {{-- Table --}}
    <div class="overflow-hidden rounded-lg border shadow-sm mb-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($rows as $row)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $row['id'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $row['name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Actions --}}
    <div class="flex space-x-3">
        <x-filament::button
            color="primary"
            wire:click="
                @if(auth()->user()->hasPermissionTo('employee_test_page_1_add'))
                    $dispatch('notify', { type: 'success', message: 'Add clicked!' })
                @else
                    $dispatch('notify', { type: 'danger', message: 'You don’t have permission to add.' })
                @endif
            "
        >
            Add
        </x-filament::button>

        <x-filament::button
            color="danger"
            wire:click="
                @if(auth()->user()->hasPermissionTo('employee_test_page_1_delete'))
                    $dispatch('notify', { type: 'success', message: 'Delete clicked!' })
                @else
                    $dispatch('notify', { type: 'danger', message: 'You don’t have permission to delete.' })
                @endif
            "
        >
            Delete
        </x-filament::button>
    </div>
</x-filament-panels::page>
