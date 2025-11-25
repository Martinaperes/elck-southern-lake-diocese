@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-5 text-center display-5 fw-bold">Our Gallery</h2>
    
    <!-- Pure Flexbox Gallery Container -->
    <div class="gallery-container" id="galleryContainer">
        @php
            // Remove duplicate images based on URL
            $uniqueImages = $images->unique('image_url');
        @endphp

        @foreach($uniqueImages as $index => $image)
        <div class="gallery-item-card" onclick="openModal({{ $index }})">
            <div class="gallery-item position-relative overflow-hidden rounded">
                <img src="{{ asset($image->image_url) }}" 
                     class="gallery-image"
                     alt="{{ $image->title }}"
                     data-title="{{ $image->title }}"
                     data-description="{{ $image->description }}">

                <!-- Hover Overlay with Description -->
                <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white text-center p-3">
                    <div>
                        <h5 class="fw-bold mb-2">{{ $image->title }}</h5>
                        <p class="mb-0">{{ $image->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Lightbox Modal -->
<div id="galleryModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display:none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center p-0 position-relative d-flex flex-column align-items-center">
                <span class="modal-close position-absolute top-0 end-0 p-2 fs-2 text-white" onclick="closeModal()" style="cursor:pointer; z-index: 10; background: rgba(0,0,0,0.5); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">&times;</span>
                <img id="modalImage" src="" class="img-fluid rounded shadow-lg" style="max-height:70vh;">
                <div id="modalText" class="text-white mt-3 bg-dark bg-opacity-75 rounded p-3"></div>
                <div class="modal-nav mt-3 d-flex gap-3">
                    <button class="btn btn-light btn-sm" onclick="prevImage()">&#8592; Previous</button>
                    <button class="btn btn-light btn-sm" onclick="nextImage()">Next &#8594;</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center mt-5">
    <a href="" class="btn btn-primary btn-lg px-5 py-3 shadow-lg" 
       style="border-radius: 50px; font-weight: bold; transition: transform 0.2s;">
        Join Us
    </a>
</div>
<style>
.gallery-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
}

.gallery-item-card {
    flex: 0 0 calc(33.333% - 1.5rem);
    max-width: calc(33.333% - 1.5rem);
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-item-card:hover {
    transform: translateY(-8px);
}

.gallery-item {
    height: 250px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    position: relative;
    cursor: pointer;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

.overlay {
    position: absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 2;
}

.gallery-item:hover .overlay {
    opacity: 1;
}

.overlay h5 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}

.overlay p {
    font-size: 0.9rem;
}

#galleryModal {
    background: rgba(0,0,0,0.9);
    backdrop-filter: blur(5px);
}

.modal-close:hover {
    background: rgba(255,255,255,0.2);
    transform: scale(1.1);
    transition: all 0.2s ease;
}

/* Responsive */
@media (max-width: 992px) {
    .gallery-item-card {
        flex: 0 0 calc(50% - 1.5rem);
        max-width: calc(50% - 1.5rem);
    }
}

@media (max-width: 576px) {
    .gallery-item-card {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .gallery-item {
        height: 200px;
    }
    
    .overlay h5 {
        font-size: 1.1rem;
    }
    
    .overlay p {
        font-size: 0.8rem;
    }
}
</style>

<script>
    const joinBtn = document.querySelector('.btn-primary');
    joinBtn.addEventListener('mouseenter', () => joinBtn.style.transform = 'scale(1.05)');
    joinBtn.addEventListener('mouseleave', () => joinBtn.style.transform = 'scale(1)');
let currentIndex = 0;
const images = [
    @foreach($uniqueImages as $image)
    {
        src: "{{ asset($image->image_url) }}",
        title: "{{ addslashes($image->title) }}",
        description: "{{ addslashes($image->description) }}"
    },
    @endforeach
];

function openModal(index) {
    currentIndex = index;
    const modal = document.getElementById('galleryModal');
    const modalImg = document.getElementById('modalImage');
    const modalText = document.getElementById('modalText');

    const img = images[index];
    modalImg.src = img.src;
    modalImg.alt = img.title;
    modalText.innerHTML = `<h4 class="fw-bold mb-2">${img.title}</h4><p class="mb-0">${img.description}</p>`;

    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('galleryModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    openModal(currentIndex);
}

function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    openModal(currentIndex);
}

// Close modal on click outside image
document.getElementById('galleryModal').addEventListener('click', function(e) {
    if(e.target.id === 'galleryModal') closeModal();
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('galleryModal');
    if(modal.style.display === 'flex') {
        if(e.key === 'ArrowRight') nextImage();
        if(e.key === 'ArrowLeft') prevImage();
        if(e.key === 'Escape') closeModal();
    }
});
</script>
@endsection
