<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                
                {{-- MENU CHÍNH (DESKTOP) --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Trang chủ') }}
                    </x-nav-link>
                    
                    {{-- 🌟 ĐÃ THÊM: LIÊN KẾT QUẢN LÝ TIN ĐĂNG CỦA TÔI (CHỈ HIỆN KHI ĐĂNG NHẬP) 🌟 --}}
                    @auth
                    <x-nav-link :href="route('user.properties.index')" :active="request()->routeIs('user.properties.index')">
                        Tin đăng của tôi
                        {{-- HIỂN THỊ SỐ LƯỢNG (4) NẾU BIẾN $listingCount TỒN TẠI VÀ LỚN HƠN 0 --}}
                        @if (isset($listingCount) && $listingCount > 0)
                            <span class="ms-1 text-xs font-bold text-indigo-600">({{ $listingCount }})</span>
                        @endif
                    </x-nav-link>
                    @endauth
                    
                </div>
                
                {{-- KHỐI TÌM KIẾM (GIỮ NGUYÊN) --}}
                <div class="hidden sm:flex sm:items-center sm:ms-10 relative">
    <form method="GET" action="{{ route('properties.indexSearch') }}" id="search-form" 
        class="flex items-center space-x-4" 
    >
        @push('scripts')
        <script>
            const BASE_URL = "{{ url('/') }}";
            const CURRENT_CITY_ID = "{{ request('CityID', '') }}";
            const CURRENT_WARD_ID = "{{ request('WardID', '') }}";
            const LISTING_TYPE = "{{ request('ListingType', '') }}";
            const MIN_PRICE = "{{ request('MinPrice', '') }}";
            const MAX_PRICE = "{{ request('MaxPrice', '') }}";
            const MIN_AREA = "{{ request('MinArea', '') }}";
            const MAX_AREA = "{{ request('MaxArea', '') }}";
        </script>
        <script src="{{ asset('Search.js') }}"></script>
        @endpush

        <div class="nav-bar flex items-center space-x-4 flex-shrink-0">
        
        <div class="mt-1">
            <label for="city-select" class="sr-only">Tỉnh/Thành phố:</label>
            <select id="city-select" name="CityID" 
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm p-2 flex-shrink-0">
                <option value="">Chọn Tỉnh/Thành phố</option>
            </select>
        </div>
        
        <button type="button" id="toggle-adv-search" 
        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition 
                w-36 justify-center"> Tìm Kiếm Nâng Cao
</button>
        
        <button type="submit" 
        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 flex-shrink-0"
        style="background-color: #4f46e5 !important; color: #ffffff !important;"> 
    Tìm Kiếm
</button>
    </div>

        <div id="adv-serach-content" class="advanced-search-container absolute z-20 top-16 mt-1 bg-white border border-gray-200 rounded-lg shadow-xl p-4 w-96 max-w-lg space-y-3 hidden" style="left: 0; top: 48px; border-top: 3px solid #4f46e5;">

        <h3 class="font-bold text-lg border-b pb-2 mb-3">Các Tiêu Chí Lọc</h3>

        <div>
            <label for="ward-id" class="block text-sm font-medium text-gray-700">Phường/Quận:</label>
            <select id="ward-id" name="WardID"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm p-2">
                <option value="">Chọn Phường/Quận</option>
            </select>
        </div>

        <div>
            <label for="listing-type" class="block text-sm font-medium text-gray-700">Loại hình:</label>
            <select id="listing-type" name="ListingType" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm p-2">
                <option value="">Tất cả</option>
                <option value="Sale">Bán</option>
                <option value="Rent">Thuê</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Giá (VNĐ):</label>
            <div class="flex space-x-2 mt-1">
                <input type="number" name="MinPrice" placeholder="Giá Min" value="" class="block w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm p-2" min="0">
                <input type="number" name="MaxPrice" placeholder="Giá Max" value="" class="block w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm p-2" min="0">
            </div>
        </div>
        
        </div>
    </form>
</div>
                
                {{-- ADMIN DASHBOARD LINK (HORIZONTAL) --}}
                @auth
                    @if (Auth::user()->RoleID == 1)
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') || request()->routeIs('admin.*')">
                                {{ __('Quản Trị') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
            </div>
            
            {{-- KHỐI ĐĂNG TIN VÀ PROFILE --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth 
                    <a href="{{ route('properties.create') }}"
                        style="margin-right: 20px;" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-red-500 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Đăng tin
                    </a>
                    
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
    
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            
                            {{-- LIÊN KẾT QUẢN LÝ TIN ĐĂNG TRONG DROPDOWN --}}
                            <x-dropdown-link :href="route('user.properties.index')">
                                Quản lý Tin đăng 
                                @if (isset($listingCount) && $listingCount > 0)
                                    <span class="ms-1 text-xs font-bold text-indigo-600">({{ $listingCount }})</span>
                                @endif
                            </x-dropdown-link>
                            
                            @if (Auth::user()->RoleID == 1)
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    {{ __('Quản Trị') }}
                                </x-dropdown-link>
                            @endif
    
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="#"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900 focus:outline-none">{{ __('Log in') }}</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-gray-900 focus:outline-none">{{ __('Register') }}</a>
                    </div>
                @endauth
            </div>

            {{-- MOBILE MENU BUTTON --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- RESPONSIVE NAVIGATION MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('properties.index')" :active="request()->routeIs('properties.index')">
                {{ __('Bất Động Sản') }}
            </x-responsive-nav-link>
            
            {{-- 🌟 ĐÃ THÊM: LIÊN KẾT QUẢN LÝ TIN ĐĂNG (MOBILE) 🌟 --}}
            @auth
            <x-responsive-nav-link :href="route('user.properties.index')" :active="request()->routeIs('user.properties.index')">
                Quản lý Tin đăng 
                @if (isset($listingCount) && $listingCount > 0)
                    <span class="ms-1 text-xs font-bold text-indigo-600">({{ $listingCount }})</span>
                @endif
            </x-responsive-nav-link>
            
            {{-- THÊM ADMIN DASHBOARD (MOBILE) --}}
            @if (Auth::user()->RoleID == 1)
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') || request()->routeIs('admin.*')">
                    {{ __('Quản Trị') }}
                </x-responsive-nav-link>
            @endif
            @endauth
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth 
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            @else
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>