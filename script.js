// Array untuk gambar slideshow
const images = [
    "WEB/1723094678-1200x675.webp",
    "WEB/download (16).jpg",
    "WEB/download (17).jpg",
    "WEB/download (18).jpg"
];

// Target elemen img
const slideshow = document.getElementById("slideshow");

let currentImageIndex = 0;

// Fungsi untuk mengganti gambar
function changeImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length; // Ganti indeks
    slideshow.style.opacity = 0; // Hilangkan gambar sejenak (animasi)
    
    setTimeout(() => {
        slideshow.src = images[currentImageIndex];
        slideshow.style.opacity = 1; // Munculkan gambar baru
    }, 500); // Tunggu 500ms untuk transisi
}

// Set interval untuk mengganti gambar setiap 3 detik
setInterval(changeImage, 3000);
