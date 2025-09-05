<x-filament::page>
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold">Test Page 2</h1>

        @if($canAdd)
            <button wire:click="addRow" class="filament-button">
                Add Row
            </button>
        @endif
    </div>

    <div class="space-y-3">
        @forelse($rows as $row)
            <div class="p-3 bg-white rounded shadow-sm flex items-center justify-between">
                <div>{{ $row['name'] }}</div>

                @if($canDelete)
                    <button wire:click="deleteRow({{ $row['id'] }})" class="text-sm">
                        Delete
                    </button>
                @endif
            </div>
        @empty
            <div class="text-gray-500">No rows found.</div>
        @endforelse
    </div>
</x-filament::page>
