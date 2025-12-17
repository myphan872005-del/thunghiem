// File: public/Search.js (Đã sửa lỗi console.log)

document.addEventListener("DOMContentLoaded", function () {
    // Kiểm tra và khởi tạo các biến toàn cục (đã được khai báo trong Blade)
    if (typeof BASE_URL === "undefined") {
        console.error(
            "Lỗi: Biến BASE_URL chưa được định nghĩa. Vui lòng kiểm tra lại @push('scripts') trong Blade."
        );
        return;
    }

    const citySelect = document.getElementById("city-select");
    const wardSelect = document.getElementById("ward-id");
    const toggleBtn = document.getElementById("toggle-adv-search");
    const advBox = document.getElementById("adv-serach-content");

    const CITY_API_URL = `${BASE_URL}/getCity`;
    const WARD_API_BASE_URL = `${BASE_URL}/getWard`;

    // Hàm Tải Tỉnh/Thành phố
    async function fetchCities() {
        try {
            const res = await fetch(CITY_API_URL);
            if (!res.ok) throw new Error("Lỗi mạng khi tải Cities");
            const data = await res.json();

            console.log("Tải Tỉnh/Thành phố:", data); // Chỉ để debug nếu cần
            citySelect.innerHTML =
                '<option value="">Chọn Tỉnh/Thành phố</option>';

            // ⭐️ ĐÃ SỬA LỖI 1: Xóa dòng console.log(cityID, data); gây lỗi ReferenceError ⭐️

            data.data.forEach((city) => {
                const opt = document.createElement("option");
                opt.value = city.CityID;
                opt.textContent = city.Name;

                // Sử dụng biến toàn cục CURRENT_CITY_ID
                if (city.id == CURRENT_CITY_ID) {
                    opt.selected = true;
                }

                citySelect.appendChild(opt);
            });

            // Nếu có giá trị CityID trong URL, tải Wards ngay lập tức
            if (citySelect.value) {
                fetchWards(citySelect.value);
            }
        } catch (error) {
            console.error("Lỗi khi tải Tỉnh/Thành phố:", error);
        }
    }

    // Hàm Tải Phường/Quận
    async function fetchWards(cityID) {
        if (!cityID) return; // Bảo đảm an toàn nếu CityID rỗng

        wardSelect.innerHTML = '<option value="">Chọn Phường/Quận</option>';

        try {
            const res = await fetch(`${WARD_API_BASE_URL}/${cityID}`);
            if (!res.ok) throw new Error("Lỗi mạng khi tải Wards");
            const data = await res.json();

            // Nếu muốn debug, hãy console.log như thế này:
            // console.log("Tải Wards cho CityID:", cityID, data);

            data.data.forEach((ward) => {
                const opt = document.createElement("option");
                opt.value = ward.WardID;
                opt.textContent = ward.Name;

                // Sử dụng biến toàn cục CURRENT_WARD_ID
                if (ward.id == CURRENT_WARD_ID) {
                    opt.selected = true;
                }

                wardSelect.appendChild(opt);
            });
        } catch (error) {
            console.error("Lỗi khi tải Phường/Quận:", error);
        }
    }

    // Lắng nghe sự kiện thay đổi Tỉnh/Thành phố
    citySelect.addEventListener("change", function () {
        if (this.value) {
            fetchWards(this.value);
        } else {
            wardSelect.innerHTML = '<option value="">Chọn Phường/Quận</option>';
        }
    });

    // ⭐️ LOGIC KIỂM TRA BỘ LỌC NÂNG CAO & HIỂN THỊ BAN ĐẦU ⭐️
    const hasAdvancedFilters =
        Boolean(CURRENT_WARD_ID) ||
        (LISTING_TYPE !== "" && LISTING_TYPE !== "Tất cả") ||
        Boolean(MIN_PRICE) ||
        Boolean(MAX_PRICE) ||
        Boolean(MIN_AREA) ||
        Boolean(MAX_AREA);

    // Hiển thị ban đầu
    if (hasAdvancedFilters) {
        advBox.classList.remove("hidden");
        toggleBtn.textContent = "Ẩn Tiêu Chí Lọc";
    } else {
        advBox.classList.add("hidden");
        toggleBtn.textContent = "Tìm Kiếm Nâng Cao";
    }

    // Logic toggle khi click
    toggleBtn.addEventListener("click", () => {
        advBox.classList.toggle("hidden");

        toggleBtn.textContent = advBox.classList.contains("hidden")
            ? "Tìm Kiếm Nâng Cao"
            : "Ẩn Tiêu Chí Lọc";
    });

    document.addEventListener("click", function (event) {
        // Kiểm tra xem click có nằm bên trong nút toggle hay bảng lọc không
        const isClickInsideToggle = toggleBtn.contains(event.target);
        const isClickInsideAdvBox = advBox.contains(event.target);

        // Nếu bảng lọc đang mở (không có class 'hidden')
        if (!advBox.classList.contains("hidden")) {
            // Và click không nằm trong nút toggle VÀ không nằm trong bảng lọc
            if (!isClickInsideToggle && !isClickInsideAdvBox) {
                advBox.classList.add("hidden");
                toggleBtn.textContent = "Tìm Kiếm Nâng Cao";
            }
        }
    });
    // Khởi chạy logic chính
    fetchCities();
});
