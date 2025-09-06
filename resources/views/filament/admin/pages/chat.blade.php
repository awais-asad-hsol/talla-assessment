{{-- @vite(['resources/js/app.js']) --}}
<x-filament-panels::page>
    <div class="space-y-4">
        {{-- Employee Selector --}}
        <div>
            <label class="block mb-1 font-medium">Select Employee</label>
            <select wire:model="selectedEmployee" wire:change="loadMessages" 
                    class="w-1/3 px-3 py-2 rounded-md border dark:bg-gray-800 dark:text-white">
                <option value="">-- Select --</option>
                @foreach ($employees as $emp)
                    <option value="{{ $emp['id'] }}">{{ $emp['name'] }} ({{ $emp['email'] }})</option>
                @endforeach
            </select>
        </div>

        @if ($selectedEmployee)
            {{-- Chat Box --}}
            <div class="flex flex-col h-[70vh] border rounded-md overflow-hidden bg-white dark:bg-gray-900">
                {{-- Messages --}}
                <div class="flex-1 overflow-y-auto p-4 space-y-2">
                    @forelse ($messages as $msg)
                        <div class="flex {{ $msg['sender_id'] === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs px-3 py-2 rounded-lg text-sm
                                {{ $msg['sender_id'] === auth()->id() 
                                    ? 'bg-blue-600 text-white' 
                                    : 'bg-gray-200 dark:bg-gray-700 dark:text-gray-100' }}">
                                <span class="block font-semibold">
                                    {{ $msg['sender']['name'] ?? 'Unknown' }}
                                </span>
                                {{ $msg['content'] }}
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">No messages yet</p>
                    @endforelse
                </div>

                {{-- Input --}}
                <div class="border-t p-3 flex items-center gap-2 bg-gray-50 dark:bg-gray-800">
                    <input type="text" wire:model="newMessage" 
                           class="flex-1 px-3 py-2 rounded-md text-black dark:text-white bg-white dark:bg-gray-700 border" 
                           placeholder="Type a message...">
                    <x-filament::button wire:click="sendMessage">Send</x-filament::button>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
