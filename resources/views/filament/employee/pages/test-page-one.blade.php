<x-filament-panels::page>
    <h2 class="text-lg font-bold mb-4">Test Page 1</h2>

    {{-- Add Row Button (only if user has add permission) --}}
    @if ($canAdd)
        <x-filament::button wire:click="addRow" class="mb-4">
            + Add Row
        </x-filament::button>
    @endif

    <table class="min-w-full border rounded">
        <thead>
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Name</th>
                @if ($canDelete)
                    <th class="px-4 py-2 border text-center">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td class="px-4 py-2 border">{{ $row['id'] }}</td>
                    <td class="px-4 py-2 border">{{ $row['name'] }}</td>

                    {{-- Delete button (only if user has delete permission) --}}
                    @if ($canDelete)
                        <td class="px-4 py-2 border text-center">
                            <x-filament::button color="danger" wire:click="deleteRow({{ $row['id'] }})" size="sm">
                                Delete
                            </x-filament::button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament-panels::page>
