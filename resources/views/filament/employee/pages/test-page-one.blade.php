<x-filament-panels::page>
    @if ($restricted)
        <div class="text-center space-y-4">
            <h2 class="text-xl font-semibold text-red-600">Restricted Access</h2>
            <p>You don’t have permission to view this page.</p>
        </div>
    @else
        <h2 class="text-lg font-bold mb-4">Test Page 1</h2>

        <table class="min-w-full border rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        <td class="px-4 py-2 border">{{ $row['id'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['name'] }}</td>
                        <td class="px-4 py-2 border">
                            @if ($canDelete)
                                <x-filament::button size="sm" color="danger">Delete</x-filament::button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($canAdd)
            <div class="mt-4">
                <x-filament::button color="primary">Add New Row</x-filament::button>
            </div>
        @endif
    @endif
</x-filament-panels::page>
