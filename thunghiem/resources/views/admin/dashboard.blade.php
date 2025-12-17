<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg mb-6">
                <h3 class="text-lg font-bold mb-4">Quản lý Hệ thống</h3>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.properties.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Tin Đăng Cần Duyệt
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Quản lý Người Dùng
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Chào mừng bạn trở lại, Admin! Hãy sử dụng Menu trên để quản lý tin đăng và người dùng.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>