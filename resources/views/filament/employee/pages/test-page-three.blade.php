<x-filament-panels::page>
    <h2 class="text-lg font-bold mb-4">Test Page 3</h2>

    <table class="min-w-full border rounded">
        <thead>
            <tr >
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td class="px-4 py-2 border">{{ $row['id'] }}</td>
                    <td class="px-4 py-2 border">{{ $row['name'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament-panels::page>
