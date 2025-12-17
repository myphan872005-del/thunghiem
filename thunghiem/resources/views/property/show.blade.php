<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chi tiết tin đăng') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div>
                            <img src="{{ asset('storage/' . $property->Image) }}" 
                                 alt="{{ $property->Title }}" 
                                 class="w-full h-auto object-cover rounded-lg shadow-lg border">
                        </div>

                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $property->Title }}</h1>
                            
                            <p class="text-gray-500 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $property->Address }}, {{ $property->ward->Name ?? '' }}, {{ $property->city->Name ?? '' }}
                            </p>

                            <div class="flex items-center space-x-4 mb-6">
                                <span class="text-2xl font-bold text-red-600">
                                    {{ number_format($property->Price) }} VNĐ
                                </span>
                                <span class="text-gray-400">|</span>
                                <span class="text-lg font-semibold text-gray-700">
                                    {{ $property->Area }} m²
                                </span>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Loại tin:</span>
                                        <span class="font-bold block">{{ $property->ListingType == 'Sale' ? 'Cần Bán' : 'Cho Thuê' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Ngày đăng:</span>
                                        <span class="font-bold block">{{ $property->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Người liên hệ:</span>
                                        <span class="font-bold block">{{ $property->user->name ?? 'Ẩn danh' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Email:</span>
                                        <span class="font-bold block">{{ $property->user->email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex space-x-3">
                                <button class="bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-700 w-full">
                                    Liên hệ ngay
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200">

                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Mô tả chi tiết</h3>
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $property->Description }}
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t">
                        <a href="{{ route('home') }}" class="text-blue-600 hover:underline flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Quay lại danh sách
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>