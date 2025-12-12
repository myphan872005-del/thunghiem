document.addEventListener("DOMContentLoaded", function () {
    const locationData = {
        10: [
            // Đà Nẵng (CityID = 10)
            { id: "101", name: "Quận Hải Châu" },
            { id: "102", name: "Quận Sơn Trà" },
        ],
        20: [
            // Quảng Nam (CityID = 20)
            { id: "201", name: "TP Hội An" },
            { id: "202", name: "TP Tam Kỳ" },
        ],
    };

    const citySelect = document.getElementById("city-select");
    const wardSelect = document.getElementById("ward-id");

    function populateWardOptions(cityID) {
        wardSelect.innerHTML = '<option value="">Chọn Phường/Quận</option>';

        const wards = locationData[cityID];
        if (wards) {
            wards.forEach((ward) => {
                const option = document.createElement("option");
                option.value = ward.id;
                option.textContent = ward.name;
                wardSelect.appendChild(option);
            });
        }
    }

    citySelect.addEventListener("change", (event) => {
        const selectedCityID = event.target.value;
        populateWardOptions(selectedCityID);
    });

    const toggleButton = document.getElementById("toggle-adv-search");
    const advSearchContent = document.getElementById("adv-serach-content");

    // Sự kiện khi bấm nút "Tìm Kiếm Nâng Cao"
    toggleButton.addEventListener("click", () => {
        advSearchContent.classList.toggle("active");

        if (advSearchContent.classList.contains("active")) {
            toggleButton.textContent = "Ẩn Tiêu Chí Lọc";
        } else {
            toggleButton.textContent = "Tìm Kiếm Nâng Cao";
        }
    });

    if (citySelect.value) {
        populateWardOptions(citySelect.value);
    }

    //lấy dữ liệu và fetch
    const searchForm = document.getElementById("search-form");

    searchForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const formData = new FormData(searchForm);
        const searchParams = {};

        for (const [key, value] of formData.entries()) {
            if (value !== "" && value !== "0") {
                searchParams[key] = value;
            }
        }

        const queryString = new URLSearchParams(searchParams).toString();
        const searchURL = `/FinalWeb/public/search?${queryString}`; // Thay đổi URL này

        fetch(searchURL)
            .then((response) => response.json())
            .then((data) => {
                // Xử lý và hiển thị dữ liệu kết quả (data)
                console.log("Kết quả tìm kiếm:", data);
            })
            .catch((error) => {
                console.error("Lỗi khi tìm kiếm:", error);
            });
    });
});
