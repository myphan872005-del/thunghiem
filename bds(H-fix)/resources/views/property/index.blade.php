<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách Bất Động Sản') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($properties->count() > 0)
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" style="gap: 100px;">
                    
                    @foreach($properties as $property)
                    
                    <a href="{{ route('properties.show', $property->PropertyID) }}" 
                       style="margin-bottom: 40px;" 
                       class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-row h-48 cursor-pointer">
                        
                        <div class="relative w-48 flex-shrink-0">
                            <img src="{{ asset('storage/' . $property->Image) }}" alt="{{ $property->Title }}" class="w-full h-full object-cover">
                            
                            <span class="absolute top-0 left-0 px-2 py-1 bg-blue-600 text-white text-xs font-bold uppercase rounded-br-lg">
                                {{ $property->ListingType == 'Sale' ? 'Bán' : 'Thuê' }}
                            </span>
                            
                            <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-60 text-white text-center py-1 text-sm font-bold">
                                {{ number_format($property->Price) }} VNĐ
                            </div>
                        </div>

                        <div class="p-4 flex flex-col justify-between flex-1">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 line-clamp-2 mb-1 hover:text-blue-600" title="{{ $property->Title }}">
                                    {{ $property->Title }}
                                </h3>
                                
                                <div class="flex items-start text-gray-500 text-xs mb-2">
                                    <svg class="w-3 h-3 mr-1 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="line-clamp-1">
                                        {{ $property->Address }}, {{ $property->ward->Name ?? '' }}, {{ $property->city->Name ?? '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center border-t pt-2 mt-auto">
                                <div class="flex items-center text-gray-700 font-bold text-sm">
                                    <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                                    {{ $property->Area }} m²
                                </div>
                                <div class="text-xs text-gray-400 italic">
                                    {{ $property->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                    </a> 
                    @endforeach

                </div>

                <div class="mt-6">
                    {{ $properties->links() }}
                </div>

            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 text-center">
                    <p class="text-gray-500">Chưa có tin đăng nào.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>