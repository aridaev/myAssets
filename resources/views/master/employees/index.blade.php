<x-app-layout>
    <x-slot name="header">Karyawan</x-slot>

    <div class="flex items-center gap-2 mb-4">
        <a href="{{ route('employees.create') }}" class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Tambah</a>
        <a href="{{ route('employees.download-template') }}" class="px-3 py-1.5 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700">Download Template</a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Departemen</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aset</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($employees as $employee)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 font-medium text-gray-900">{{ $employee->employee_id }}</td>
                        <td class="px-4 py-2 text-gray-900">{{ $employee->name }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ $employee->department ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-600">{{ $employee->assets_count }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $employee->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $employee->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </td>
                        <td class="px-4 py-2 text-right">
                            <a href="{{ route('employees.edit', $employee) }}" class="text-gray-500 hover:text-yellow-600 mr-2">Edit</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?')">@csrf @method('DELETE')<button type="submit" class="text-gray-500 hover:text-red-600">Hapus</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada karyawan.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($employees->hasPages())<div class="px-4 py-3 border-t">{{ $employees->links() }}</div>@endif
    </div>
</x-app-layout>
