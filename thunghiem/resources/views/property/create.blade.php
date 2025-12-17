<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Đăng Tin Bất Động Sản') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                        <p class="font-bold">Chú ý!</p>
                        <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    
                    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tiêu đề tin (*)</label>
                            <input type="text" name="Title" class="border rounded w-full py-2 px-3 text-gray-700" required placeholder="VD: Bán nhà mặt tiền...">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Giá (VNĐ) (*)</label>
                                <input type="number" name="Price" class="border rounded w-full py-2 px-3 text-gray-700" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Diện tích (m2) (*)</label>
                                <input type="number" step="0.1" name="Area" class="border rounded w-full py-2 px-3 text-gray-700" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Loại tin (*)</label>
                                <select name="ListingType" class="border rounded w-full py-2 px-3 text-gray-700">
                                    <option value="Sale">Cần bán</option>
                                    <option value="Rent">Cho thuê</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tỉnh / Thành phố (*)</label>
                                <select name="CityID" id="city_select" class="border rounded w-full py-2 px-3 text-gray-700" required>
                                    <option value="">-- Chọn Tỉnh/TP --</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->CityID }}">{{ $city->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Phường / Xã (*)</label>
                                <select name="WardID" id="ward_select" class="border rounded w-full py-2 px-3 text-gray-700" required>
                                    <option value="">-- Vui lòng chọn Tỉnh trước --</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Số nhà, Tên đường (*)</label>
                            <input type="text" name="Address" class="border rounded w-full py-2 px-3 text-gray-700" required placeholder="VD: 123 Đường Nguyễn Huệ">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Ảnh đại diện (*)</label>
                            <input type="file" name="Image" class="border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Mô tả chi tiết</label>
                            <textarea name="Description" rows="4" class="border rounded w-full py-2 px-3 text-gray-700"></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" 
                            style="background-color: #dc2626; color: white;"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out shadow-lg">
                            Đăng Tin Ngay
                            </button>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('city_select').addEventListener('change', function() {
            var cityId = this.value;
            var wardSelect = document.getElementById('ward_select');
            
            // Reset lại ô chọn phường
            wardSelect.innerHTML = '<option value="">Đang tải...</option>';

            if(cityId) {
                // Gọi API lấy phường
                fetch('/get-wards/' + cityId)
                    .then(response => response.json())
                    .then(data => {
                        wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                        data.forEach(ward => {
                            // Tạo thẻ option mới
                            var option = document.createElement('option');
                            option.value = ward.WardID; // Dùng đúng tên cột trong DB
                            option.text = ward.Name;
                            wardSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Lỗi:', error));
            } else {
                wardSelect.innerHTML = '<option value="">-- Vui lòng chọn Tỉnh trước --</option>';
            }
        });
    </script>
</x-app-layout>