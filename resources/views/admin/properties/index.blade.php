@extends('layouts.app')

{{-- HEADER ADMIN --}}
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Quản Lý Tin Đăng (Admin)') }} 
        <span class="text-sm font-normal text-gray-500">({{ $properties->total() ?? 0 }} tin)</span>
    </h2>
@endsection

{{-- CONTENT ADMIN --}}
@section('content')
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Thông báo --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg font-bold border border-green-200">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg font-bold border border-red-200">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề / Địa chỉ</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Người đăng (Cấp độ)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại tin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá / Diện tích</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($properties as $property)
                                    <tr class="{{ ($property->Status ?? '') == 'Pending' ? 'bg-yellow-50/50' : '' }}">
                                        
                                        {{-- ID --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $property->PropertyID }}
                                        </td>

                                        {{-- TIÊU ĐỀ --}}
                                        <td class="px-6 py-4 max-w-xs overflow-hidden">
                                            <a href="{{ route('properties.show', $property->PropertyID) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 font-bold block truncate">
                                                {{ $property->Title }}
                                            </a>
                                            <p class="text-xs text-gray-400 mt-1 truncate">
                                                {{ $property->Address }}, {{ $property->city->Name ?? '' }}
                                            </p>
                                        </td>

                                        {{-- 🔥 NGƯỜI ĐĂNG (CÓ MÀU CẤP ĐỘ) 🔥 --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @php
                                                $user = $property->user;
                                                $rank = $user ? $user->rank_info : null; // Gọi hàm trong Model User
                                            @endphp

                                            @if($user)
                                                <div class="flex flex-col">
                                                    <span class="{{ $rank['color'] ?? 'text-gray-900' }} font-bold text-base">
                                                        {{ $user->name }} 
                                                        <span class="ml-1 text-lg" title="{{ $rank['name'] ?? '' }}">{{ $rank['icon'] ?? '' }}</span>
                                                    </span>
                                                    <span class="text-xs text-gray-500">{{ $rank['name'] ?? 'Thành viên' }}</span>
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">User đã xóa</span>
                                            @endif
                                        </td>

                                        {{-- LOẠI TIN --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ ($property->ListingType ?? '') == 'Sale' ? 'Bán' : 'Thuê' }}
                                        </td>

                                        {{-- GIÁ --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <span class="font-bold">
                                                {{ number_format(($property->Price ?? 0) / 1000000000, 2) }} tỷ
                                            </span>
                                            <p class="text-xs text-gray-500">{{ $property->Area ?? 0 }} m²</p>
                                        </td>

                                        {{-- TRẠNG THÁI --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (($property->Status ?? '') == 'Pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    Chờ duyệt
                                                </span>
                                            @elseif (($property->Status ?? '') == 'Approved')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                                    Đã duyệt
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                                    Từ chối
                                                </span>
                                            @endif
                                        </td>

                                        {{-- THAO TÁC --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            
                                            {{-- NÚT DUYỆT (Chỉ hiện khi Pending) --}}
                                            @if (($property->Status ?? '') == 'Pending') 
                                                <form action="{{ route('admin.properties.approve', $property->PropertyID) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            onclick="return confirm('Bạn có chắc chắn muốn DUYỆT tin này?')"
                                                            class="text-green-600 hover:text-green-900 font-bold text-xs bg-green-50 px-2 py-1 rounded border border-green-200 hover:bg-green-100 transition">
                                                        Duyệt
                                                    </button>
                                                </form>
                                            @endif 

                                            {{-- NÚT XÓA --}}
                                            <form action="{{ route('admin.properties.destroy', $property->PropertyID) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Xóa tin này? Hành động này không thể hoàn tác!')"
                                                        class="text-red-600 hover:text-red-900 font-bold text-xs bg-red-50 px-2 py-1 rounded border border-red-200 hover:bg-red-100 transition">
                                                    Xóa
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-500 italic">
                                            Chưa có tin đăng nào trong hệ thống.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $properties->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection