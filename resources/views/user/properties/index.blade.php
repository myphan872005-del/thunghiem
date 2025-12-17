@extends('layouts.app')

{{-- Phần Header (Tiêu đề) --}}
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Quản Lý Tin Đăng') }} 
        {{-- Dùng count() cho lành, tránh lỗi nếu chưa phân trang --}}
        ({{ $properties->count() }} tin)
    </h2>
@endsection

{{-- Phần Nội dung chính --}}
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Thông báo thành công --}}
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
                                @forelse ($properties as $property)
                                    <tr class="{{ ($property->Status ?? '') == 'Pending' ? 'bg-yellow-50/50' : '' }}">
                                        {{-- 🌟 DÙNG PropertyID CHUẨN CHỈ --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $property->PropertyID }}
                                        </td>
                                        <td class="px-6 py-4 max-w-xs overflow-hidden truncate">
                                            <a href="{{ route('properties.show', $property->PropertyID) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                                {{ $property->Title }}
                                            </a>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $property->Address }}, {{ $property->city->Name ?? '' }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->user->name ?? 'User đã xóa' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ ($property->ListingType ?? '') == 'Sale' ? 'Bán' : 'Thuê' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ number_format(($property->Price ?? 0) / 1000000000, 2) }} tỷ
                                            <p class="text-xs text-gray-500">{{ $property->Area ?? 0 }} m²</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (($property->Status ?? '') == 'Pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Chờ duyệt</span>
                                            @elseif (($property->Status ?? '') == 'Approved')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Đã duyệt</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Từ chối</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-y-1">
                                            
                                            {{-- NÚT DUYỆT (Chỉ hiện khi Pending) --}}
                                            @if (($property->Status ?? '') == 'Pending') 
                                                <form action="{{ route('admin.properties.approve', $property->PropertyID) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" onclick="return confirm('Duyệt tin này?')" class="text-green-600 hover:text-green-900 font-bold mr-2">
                                                        Duyệt
                                                    </button>
                                                </form>
                                            @endif 

                                            {{-- NÚT XÓA --}}
                                            <form action="{{ route('admin.properties.destroy', $property->PropertyID) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Xóa tin này?')" class="text-red-600 hover:text-red-900 font-bold">
                                                    Xóa
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center p-4">Chưa có tin đăng nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- PHÂN TRANG (Kiểm tra xem có method links không) --}}
                    @if(method_exists($properties, 'links'))
                        <div class="mt-4">
                            {{ $properties->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection