@extends('layouts.app')

{{-- HEADER USER --}}
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Quản Lý Tin Đăng Của Tôi') }}
        <span class="text-sm font-normal text-gray-500">({{ $properties->total() ?? 0 }} tin)</span>
    </h2>
@endsection

{{-- CONTENT USER --}}
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- 🔥 PHẦN 1: THANH CẤP ĐỘ (GAMIFICATION) 🔥 --}}
        <div class="mb-8 bg-white rounded-xl p-6 border border-gray-200 shadow-sm flex flex-col md:flex-row items-center gap-6">
            {{-- Huy hiệu --}}
            <div class="relative">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-white font-bold text-3xl shadow-lg
                    {{ ($color ?? 'gray') == 'purple' ? 'bg-purple-600' : (($color ?? 'gray') == 'blue' ? 'bg-blue-500' : 'bg-gray-500') }}">
                    {{ substr($rankName ?? 'S', 0, 1) }}
                </div>
                <div class="absolute -bottom-2 -right-2 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full border-2 border-white shadow-sm">
                    LV.{{ ($approvedCount ?? 0) >= 10 ? 'MAX' : (($approvedCount ?? 0) >= 5 ? '2' : '1') }}
                </div>
            </div>

            {{-- Thông tin và Thanh chạy --}}
            <div class="flex-1 w-full">
                <div class="flex justify-between items-end mb-2">
                    <div>
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Cấp độ hiện tại</p>
                        <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            {{ $rankName ?? 'Sơ cấp' }}
                            @if(($rankName ?? '') == 'Cao Cấp (VIP)')
                                <span class="text-yellow-500 text-xl" title="Uy tín cao">👑</span>
                            @endif
                        </h3>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">
                            Đã duyệt: <span class="font-bold text-indigo-600 text-lg">{{ $approvedCount ?? 0 }}</span> / {{ $target ?? 5 }} tin
                        </p>
                    </div>
                </div>

                {{-- Thanh Progress Bar --}}
                <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden shadow-inner">
                    <div class="h-4 rounded-full transition-all duration-1000 ease-out relative
                        {{ ($color ?? 'gray') == 'purple' ? 'bg-gradient-to-r from-purple-500 to-pink-500' : (($color ?? 'gray') == 'blue' ? 'bg-gradient-to-r from-blue-400 to-blue-600' : 'bg-gray-500') }}"
                        style="width: {{ $progressPercent ?? 0 }}%">
                    </div>
                </div>

                <p class="text-xs text-gray-500 mt-2 italic">
                    @if(($approvedCount ?? 0) >= 10)
                        Chúc mừng! Bạn là thành viên VIP. Tin đăng của bạn sẽ được ưu tiên hiển thị! 🚀
                    @else
                        Đăng thêm <b>{{ ($target ?? 5) - ($approvedCount ?? 0) }}</b> tin hợp lệ nữa để thăng hạng <b>{{ $nextRank ?? 'Tiếp theo' }}</b>.
                    @endif
                </p>
            </div>
        </div>

        {{-- 🔥 PHẦN 2: BẢNG DANH SÁCH TIN ĐĂNG 🔥 --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                @if (session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 font-medium border border-green-200">
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
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($properties as $property)
                            <tr class="{{ ($property->Status ?? '') == 'Pending' ? 'bg-yellow-50/50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $property->PropertyID }}
                                </td>
                                <td class="px-6 py-4 max-w-xs overflow-hidden truncate">
                                    <a href="{{ route('properties.show', $property->PropertyID) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 font-semibold block truncate">
                                        {{ $property->Title }}
                                    </a>
                                    <p class="text-xs text-gray-400 mt-1 truncate">{{ $property->Address }}</p>
                                </td>

                                {{-- 🔥 CỘT NGƯỜI ĐĂNG (CÓ MÀU CẤP ĐỘ) 🔥 --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $user = $property->user;
                                        $rank = $user ? $user->rank_info : null;
                                    @endphp

                                    @if($user)
                                        <div class="flex flex-col">
                                            {{-- Tên có màu + Icon --}}
                                            <span class="{{ $rank['color'] ?? 'text-gray-900' }} font-bold text-base">
                                                {{ $user->name }} 
                                                <span class="ml-1 text-lg">{{ $rank['icon'] ?? '' }}</span>
                                            </span>
                                            {{-- Tên cấp độ nhỏ --}}
                                            <span class="text-xs text-gray-500 mt-0.5">
                                                {{ $rank['name'] ?? 'Thành viên' }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">User đã xóa</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ ($property->ListingType ?? '') == 'Sale' ? 'Bán' : 'Thuê' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <span class="font-bold">
                                        {{ number_format(($property->Price ?? 0) / 1000000000, 2) }} tỷ
                                    </span>
                                    <p class="text-xs text-gray-500">{{ $property->Area ?? 0 }} m²</p>
                                </td>
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
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <form action="{{ route('admin.properties.destroy', $property->PropertyID) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin này?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-xs font-bold hover:underline">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    Bạn chưa có tin đăng nào. Hãy đăng tin ngay để lên cấp!
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