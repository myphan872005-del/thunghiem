<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản Lý Tin Đăng') }} ({{ $properties->total() ?? 0 }} tin)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Người đăng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại tin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá/Diện tích</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($properties as $property)
                                    <tr class="{{ $property->Status == 'Pending' ? 'bg-yellow-50/50' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $property->PropertyID }}
                                        </td>
                                        <td class="px-6 py-4 max-w-xs overflow-hidden truncate">
                                            <a href="{{ route('properties.show', $property->PropertyID) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                                {{ $property->Title }}
                                            </a>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $property->Address }}, {{ $property->city->Name ?? 'N/A' }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->user->name ?? 'User đã xóa' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $property->ListingType == 'Sale' ? 'Bán' : 'Thuê' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ number_format($property->Price / 1000000000, 2) }} tỷ
                                            <p class="text-xs text-gray-500">{{ $property->Area }} m²</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($property->Status == 'Pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Chờ duyệt
                                                </span>
                                            @elseif ($property->Status == 'Approved')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Đã duyệt
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Từ chối
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-y-1">
                                            
                                            {{-- NÚT DUYỆT TIN (CHỈ HIỂN THỊ KHI PENDING) --}}
                                            @if ($property->Status == 'Pending') 
                                                <form action="{{ route('admin.properties.approve', $property->PropertyID) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            onclick="return confirm('Bạn có chắc chắn muốn DUYỆT tin này?')"
                                                            class="text-green-600 hover:text-green-900 font-bold text-xs p-2 rounded-md bg-green-50/70 border border-green-200">
                                                        Duyệt tin
                                                    </button>
                                                </form>
                                            @endif 

                                            {{-- NÚT XÓA TIN (ADMIN CÓ THỂ XÓA MỌI TIN) --}}
                                            <form action="{{ route('admin.properties.destroy', $property->PropertyID) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Bạn có chắc chắn muốn XÓA tin này? Hành động này không thể hoàn tác!')"
                                                        class="text-red-600 hover:text-red-900 font-bold text-xs p-2 rounded-md bg-red-50/70 border border-red-200">
                                                    Xóa tin
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- PHÂN TRANG --}}
                    <div class="mt-4">
                        {{ $properties->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>