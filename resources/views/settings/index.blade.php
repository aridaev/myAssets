<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">{{ __('Pengaturan Aplikasi') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Aplikasi -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Informasi Aplikasi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="app_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi <span class="text-red-500">*</span></label>
                                <input type="text" name="app_name" id="app_name" value="{{ $settings['app_name'] }}" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="base_url" class="block text-sm font-medium text-gray-700 mb-2">Base URL</label>
                                <input type="url" name="base_url" id="base_url" value="{{ $settings['base_url'] }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="app_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Aplikasi</label>
                                <textarea name="app_description" id="app_description" rows="2" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings['app_description'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Perusahaan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Informasi Perusahaan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>
                                <input type="text" name="company_name" id="company_name" value="{{ $settings['company_name'] }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="company_email" class="block text-sm font-medium text-gray-700 mb-2">Email Perusahaan</label>
                                <input type="email" name="company_email" id="company_email" value="{{ $settings['company_email'] }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-2">Telepon Perusahaan</label>
                                <input type="text" name="company_phone" id="company_phone" value="{{ $settings['company_phone'] }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="primary_color" class="block text-sm font-medium text-gray-700 mb-2">Warna Utama</label>
                                <input type="color" name="primary_color" id="primary_color" value="{{ $settings['primary_color'] }}" class="w-full h-10 px-2 py-1 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="company_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Perusahaan</label>
                                <textarea name="company_address" id="company_address" rows="2" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings['company_address'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Logo & Icon -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Logo & Icon</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                                @if($settings['logo'])
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings['logo']) }}" alt="Logo" class="h-16 object-contain bg-gray-50 rounded-lg p-2">
                                    </div>
                                @endif
                                <input type="file" name="logo" id="logo" accept="image/*" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <p class="text-xs text-gray-500 mt-1">Rekomendasi: 200x50 px, max 2MB</p>
                            </div>
                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon / Favicon</label>
                                @if($settings['icon'])
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($settings['icon']) }}" alt="Icon" class="h-16 w-16 object-contain bg-gray-50 rounded-lg p-2">
                                    </div>
                                @endif
                                <input type="file" name="icon" id="icon" accept="image/*" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <p class="text-xs text-gray-500 mt-1">Rekomendasi: 64x64 px, max 1MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg shadow-blue-500/25">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
