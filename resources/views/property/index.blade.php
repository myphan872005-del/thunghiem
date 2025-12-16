<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách Bất Động Sản') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Các Bất Động Sản Đang Bán/Cho Thuê</h3>
                    
                    @foreach ($properties as $property)
                        <div class="border-b py-4">
                            <h4 class="text-xl font-bold">{{ $property->Title }}</h4>
                            <p class="text-gray-600">
                                Giá: **{{ number_format($property->Price) }} VND** | Diện tích: {{ $property->Area }} m²
                            </p>
                            <p class="mt-2">
                                Địa chỉ: {{ $property->AddressDetail ?? 'Đang cập nhật' }}, 
                                {{ $property->ward->Name ?? 'N/A' }}, 
                                **{{ $property->ward->city->Name ?? 'N/A' }}**
                                (Thuộc về User: {{ $property->user->name }})
                            </p>
                        </div>
                    @endforeach

                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>