<x-filament-panels::page>
    <div class="text-center space-y-4">
        <h2 class="text-xl font-semibold text-red-600">Restricted Access</h2>
        <p>You do not have permission to view this page.</p>

        <a 
            href="{{ url()->previous() }}" 
            class="text-blue-600 hover:underline"
        >
            ← Go back
        </a>
    </div>
</x-filament-panels::page>
