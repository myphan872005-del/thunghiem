<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm kiếm Bất động sản</title>

    <style>
        .advanced-search-container {
            display: none;
            border: 1px solid #ccc;
            padding: 15px;
            margin-top: 10px;
            background-color: #f9f9f9;
        }
        .advanced-search-container.active {
            display: block;
        }
        .nav-bar {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .advanced-search-container > div {
            margin-bottom: 10px;
        }
        .listing {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<form method="GET" action="{{ route('properties.index') }}" id="search-form">

    <div class="nav-bar">
        <button type="button" id="toggle-adv-search">Tìm Kiếm Nâng Cao</button>

        <div>
            <label>Tỉnh/Thành phố:</label>
            <select id="city-select" name="CityID">
                <option value="">Chọn Tỉnh/Thành phố</option>
            </select>
        </div>

        <button type="submit">Tìm Kiếm</button>
    </div>

    <div id="adv-serach-content" class="advanced-search-container">
        <h3>Các tiêu chí lọc</h3>

        <div>
            <label>Phường/Quận:</label>
            <select id="ward-id" name="WardID">
                <option value="">Chọn Phường/Quận</option>
            </select>
        </div>

        <div>
            <label>Loại hình:</label>
            <select name="ListingType">
                <option value="">Tất cả</option>
                <option value="Bán" {{ request('ListingType')=='Bán'?'selected':'' }}>Bán</option>
                <option value="Thuê" {{ request('ListingType')=='Thuê'?'selected':'' }}>Thuê</option>
            </select>
        </div>

        <div>
            <label>Giá:</label>
            <input type="number" name="MinPrice" placeholder="Giá Min" value="{{ request('MinPrice') }}">
            <input type="number" name="MaxPrice" placeholder="Giá Max" value="{{ request('MaxPrice') }}">
        </div>

        <div>
            <label>Diện tích:</label>
            <input type="number" name="MinArea" placeholder="DT Min" value="{{ request('MinArea') }}">
            <input type="number" name="MaxArea" placeholder="DT Max" value="{{ request('MaxArea') }}">
        </div>
    </div>
</form>

<h2>Danh sách bài đăng</h2>

<script src="{{ asset('Search.js') }}"></script>

</body>
</html>
