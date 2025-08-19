@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Detail Mobil</div>
    <div class="card-body">
        <p><strong>Merk:</strong> {{ $mobil->merk }}</p>
        <p><strong>Tipe:</strong> {{ $mobil->tipe }}</p>
        <p><strong>Nomor Polisi:</strong> {{ $mobil->nopol }}</p>
        <p><strong>Harga Sewa per Hari:</strong> {{ $mobil->harga_sewa }}</p>
        <p><strong>Denda per Hari:</strong> {{ $mobil->denda_per_hari }}</p>
        <p><strong>Status:</strong> {{ $mobil->status }}</p>
        <p><strong>Disewa Berapa Kali:</strong> {{ $mobil->disewa }}</p>
        <p><strong>Jadwal Perawatan Berikutnya:</strong> {{ $mobil->jadwal_perawatan_berikutnya ? \Carbon\Carbon::parse($mobil->jadwal_perawatan_berikutnya)->format('d F Y') : '-' }}</p>
        <p><strong>Periode Perawatan:</strong> {{ $mobil->periode_perawatan_hari ? $mobil->periode_perawatan_hari . ' hari' : '-' }}</p>
        <a href="{{ route('admin.mobils.edit', $mobil->id) }}" class="btn btn-warning">Edit Mobil</a>
        <a href="{{ route('admin.mobils.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">Galeri Gambar</div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="imageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="exterior-tab" data-bs-toggle="tab" data-bs-target="#exterior" type="button" role="tab" aria-controls="exterior" aria-selected="true">Eksterior</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="interior-tab" data-bs-toggle="tab" data-bs-target="#interior" type="button" role="tab" aria-controls="interior" aria-selected="false">Interior</button>
            </li>
        </ul>
        <div class="tab-content" id="imageTabsContent">
            <div class="tab-pane fade show active" id="exterior" role="tabpanel" aria-labelledby="exterior-tab">
                <div class="row mt-3">
                    @if(isset($gambars['exterior']))
                        @foreach($gambars['exterior'] as $gambar)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-src="{{ asset('storage/' . $gambar->path) }}" data-bs-caption="{{ $gambar->urutan }}. {{ $gambar->label }}">
                                        <img src="{{ asset('storage/' . $gambar->path) }}" class="card-img-top" alt="{{ $gambar->label }}">
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text">{{ $gambar->urutan }}. {{ $gambar->label }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada gambar eksterior.</p>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="interior" role="tabpanel" aria-labelledby="interior-tab">
                <div class="row mt-3">
                    @if(isset($gambars['interior']))
                        @foreach($gambars['interior'] as $gambar)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-src="{{ asset('storage/' . $gambar->path) }}" data-bs-caption="{{ $gambar->urutan }}. {{ $gambar->label }}">
                                        <img src="{{ asset('storage/' . $gambar->path) }}" class="card-img-top" alt="{{ $gambar->label }}">
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text">{{ $gambar->urutan }}. {{ $gambar->label }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada gambar interior.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center position-relative" style="height: 500px; overflow: hidden;"> <!-- Changed to fixed height and added overflow hidden -->
                <div id="zoomContainer" style="width: 100%; height: 100%;">
                    <img src="" class="img-fluid" id="modalImage" alt="Image Preview">
                </div>
                <div class="image-nav-overlay image-nav-prev" id="imagePrev">
                    <span class="nav-icon" style="color: white !important;">&lt;</span>
                </div>
                <div class="image-nav-overlay image-nav-next" id="imageNext">
                    <span class="nav-icon" style="color: white !important;">&gt;</span>
                </div>
            </div>
            <div class="modal-footer">
                <span id="imageCaption" class="me-auto"></span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    .image-nav-overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 15%; /* Adjust as needed */
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white !important;
        font-size: 2rem; /* Increased font size */
        text-shadow: 0 0 10px rgba(0, 0, 0, 1); /* More prominent text shadow */
        font-weight: bolder; /* Make icons even bolder */
        /* opacity: 0; */ /* Removed opacity */
        /* transition: opacity 0.2s ease-in-out; */ /* Removed transition */
    }
    .image-nav-prev {
        left: 0;
    }
    .image-nav-next {
        right: 0;
    }
    .nav-icon {
        pointer-events: none; /* Prevent icon from interfering with click */
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var imageModal = document.getElementById('imageModal');
        var modalImage = imageModal.querySelector('#modalImage');
        var modalCaption = imageModal.querySelector('#imageCaption');
        var imagePrev = imageModal.querySelector('#imagePrev');
        var imageNext = imageModal.querySelector('#imageNext');
        var zoomContainer = imageModal.querySelector('#zoomContainer');

        var allImages = [];
        var currentIndex = 0;
        var currentPinchZoom = null; // To store the PinchZoom instance

        // Collect all image data
        document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#imageModal"]').forEach(function(imgLink) {
            allImages.push({
                src: imgLink.getAttribute('data-bs-src'),
                caption: imgLink.getAttribute('data-bs-caption')
            });
        });

        imageModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var imageUrl = button.getAttribute('data-bs-src');
            var imageCaption = button.getAttribute('data-bs-caption');

            // Find the index of the clicked image
            currentIndex = allImages.findIndex(function(image) {
                return image.src === imageUrl;
            });

            updateModalContent();

            // Initialize PinchZoom.js after image is loaded
            modalImage.onload = function() {
                if (currentPinchZoom) {
                    currentPinchZoom.destroy(); // Destroy previous instance if exists
                }
                currentPinchZoom = new PinchZoom(zoomContainer, {
                    // Options for PinchZoom.js (optional)
                    // For example:
                    // minZoom: 0.5,
                    // maxZoom: 4,
                    // tapZoomFactor: 2,
                });
            };
        });

        imageModal.addEventListener('hidden.bs.modal', function () {
            if (currentPinchZoom) {
                currentPinchZoom.destroy(); // Destroy instance when modal is hidden
                currentPinchZoom = null;
            }
        });

        imagePrev.addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + allImages.length) % allImages.length;
            updateModalContent();
        });

        imageNext.addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % allImages.length;
            updateModalContent();
        });

        function updateModalContent() {
            if (allImages.length > 0) {
                modalImage.src = allImages[currentIndex].src;
                modalCaption.textContent = ''; // Clear the caption in the footer
                imageModal.querySelector('#imageModalLabel').textContent = allImages[currentIndex].caption;
            }
        }
    });
</script>
@endpush

@endsection