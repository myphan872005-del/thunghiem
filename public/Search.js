document.addEventListener("DOMContentLoaded", function () {
    const citySelect = document.getElementById("city-select");
    const wardSelect = document.getElementById("ward-id");

    const selectedCity = citySelect.dataset.selected;
    const selectedWard = wardSelect.dataset.selected;

    async function fetchCities() {
        const res = await fetch("/FinalWeb/public/getCity");
        const data = await res.json();

        citySelect.innerHTML = '<option value="">Chọn Tỉnh/Thành phố</option>';

        data.data.forEach((city) => {
            const opt = document.createElement("option");
            opt.value = city.id;
            opt.textContent = city.name;

            if (city.id == "{{ request('CityID') }}") {
                opt.selected = true;
            }

            citySelect.appendChild(opt);
        });

        if (citySelect.value) {
            fetchWards(citySelect.value);
        }
    }

    async function fetchWards(cityID) {
        wardSelect.innerHTML = '<option value="">Chọn Phường/Quận</option>';

        const res = await fetch(`/FinalWeb/public/getWard/${cityID}`);
        const data = await res.json();

        data.data.forEach((ward) => {
            const opt = document.createElement("option");
            opt.value = ward.id;
            opt.textContent = ward.name;

            if (ward.id == "{{ request('WardID') }}") {
                opt.selected = true;
            }

            wardSelect.appendChild(opt);
        });
    }

    citySelect.addEventListener("change", function () {
        if (this.value) {
            fetchWards(this.value);
        }
    });

    fetchCities();

    // Toggle advanced search
    const toggleBtn = document.getElementById("toggle-adv-search");
    const advBox = document.getElementById("adv-serach-content");

    toggleBtn.addEventListener("click", () => {
        advBox.classList.toggle("active");
        toggleBtn.textContent = advBox.classList.contains("active")
            ? "Ẩn Tiêu Chí Lọc"
            : "Tìm Kiếm Nâng Cao";
    });
});
