// Ambil elemen-elemen modal
var modal = document.getElementById("myModal");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

// Fungsi untuk membuka modal
function openModal(imgElement) {
    modal.style.display = "block";
    modalImg.src = imgElement.src;
    captionText.innerHTML = imgElement.alt;
}

// Fungsi untuk menutup modal
function closeModal() {
    modal.style.display = "none";
}

// (Opsional) Tutup modal jika diklik di luar gambar
modal.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}