<x-filament::page>
    <div class="space-y-4">
        <h2 class="text-lg font-bold">Sample Table (Test Page 1)</h2>

        <table class="min-w-full border rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->getRows() as $row)
                    <tr>
                        <td class="px-4 py-2 border">{{ $row['id'] }}</td>
                        <td class="px-4 py-2 border">{{ $row['name'] }}</td>
                        <td class="px-4 py-2 border">
                            @if ($this->canDelete())
                                <x-filament::button color="danger" size="sm">
                                    Delete
                                </x-filament::button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($this->canAdd())
            <x-filament::button color="primary">
                Add New Row
            </x-filament::button>
        @endif
    </div>
</x-filament::page>
