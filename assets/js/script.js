// Alert popup custom
function showAlert(message, type = "info") {
    const box = document.createElement("div");
    box.className = `alert-box ${type}`;
    box.innerText = message;

    document.body.appendChild(box);

    setTimeout(() => {
        box.classList.add("show");
    }, 100);

    setTimeout(() => {
        box.classList.remove("show");
        setTimeout(() => box.remove(), 300);
    }, 2500);
}


// Validasi form tambah & edit barang
function validateForm() {
    const nama = document.querySelector("input[name='nama']");
    const hargaJual = document.querySelector("input[name='harga_jual']");
    const hargaBeli = document.querySelector("input[name='harga_beli']");
    const stok = document.querySelector("input[name='stok']");

    if (!nama.value.trim()) {
        showAlert("Nama barang tidak boleh kosong!", "error");
        return false;
    }
    if (isNaN(hargaJual.value) || hargaJual.value <= 0) {
        showAlert("Harga jual harus angka dan lebih dari 0!", "error");
        return false;
    }
    if (isNaN(hargaBeli.value) || hargaBeli.value <= 0) {
        showAlert("Harga beli harus angka dan lebih dari 0!", "error");
        return false;
    }
    if (isNaN(stok.value) || stok.value < 0) {
        showAlert("Stok harus angka dan tidak boleh minus!", "error");
        return false;
    }

    return true;
}


// Preview image sebelum upload
function previewImage(input, previewID = 'preview') {
    const file = input.files[0];
    const img = document.getElementById(previewID);

    if (file) {
        img.src = URL.createObjectURL(file);
        img.style.display = "block";
    }
}


// Custom confirm delete
function confirmDelete(url) {
    const confirmBox = document.createElement("div");
    confirmBox.className = "confirm-box";

    confirmBox.innerHTML = `
        <div class="confirm-content">
            <p>Yakin ingin menghapus data ini?</p>
            <button id="yesDelete" class="btn delete">Hapus</button>
            <button id="cancelDelete" class="btn cancel">Batal</button>
        </div>
    `;

    document.body.appendChild(confirmBox);

    document.getElementById("yesDelete").onclick = () => {
        window.location.href = url;
    };
    document.getElementById("cancelDelete").onclick = () => {
        confirmBox.remove();
    };
}
