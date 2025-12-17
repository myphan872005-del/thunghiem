@extends('layouts.app')

{{-- PHẦN HEADER --}}
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Quản Lý Người Dùng') }}
    </h2>
@endsection

{{-- PHẦN NỘI DUNG --}}
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên người dùng</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vai trò</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- CHÚ Ý: Ở đây dùng biến $users (Người dùng) --}}
                                @forelse ($users as $user)
                                    <tr class="{{ $user->RoleID == 1 ? 'bg-indigo-50/50' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($user->RoleID == 1)
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-indigo-100 text-indigo-800">ADMIN</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">User thường</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if ($user->RoleID == 2)
                                                <form action="{{ route('admin.users.makeAdmin', $user->id) }}" method="POST" class="inline-block">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" onclick="return confirm('Cấp quyền Admin cho {{ $user->name }}?')" class="text-green-600 hover:text-green-900 font-bold text-xs">Cấp Admin</button>
                                                </form>
                                            @elseif ($user->RoleID == 1 && $user->id !== Auth::id())
                                                <form action="{{ route('admin.users.removeAdmin', $user->id) }}" method="POST" class="inline-block">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" onclick="return confirm('Hạ quyền Admin của {{ $user->name }}?')" class="text-red-600 hover:text-red-900 font-bold text-xs">Hạ quyền</button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-xs italic">--</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center p-4">Không có người dùng nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection