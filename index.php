<?php
require_once 'includes/config.php';
$page_title  = "Gallery Mockers";
$active_page = "home";
include 'includes/header.php';
?>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/vangogh.webp" class="d-block w-100" style="height: 93vh; object-fit: cover;" alt="Van Gogh Painting"/>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Reimagining Classics</h5>
                    <p>Providing a modern twist to timeless masterpieces.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/friedrich_shmam_0109_02-56a03a2a3df78cafdaa092dc.jpg" class="d-block w-100" style="height: 93vh; object-fit: cover;" alt="Gambar Wallpaper"/>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Art Meets Irony</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/xx.jpg" class="d-block w-100" style="height: 93vh; object-fit: cover;" alt="Gambar Saturn"/>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Cosmic Perspective</h5>
                    <p>Exploring the vast beauty of the universe through contemporary art.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="filosofi-parallax">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-md-6">
                    <div class="text-box p-5 reveal">
                        <h2>Filosofi</h2>
                        <p>Gallery Mockers was born from a desire to challenge the rigidity of the art world. We believe that every masterpiece has a humorous, satirical, and surprising side. By blending traditional techniques with modern narratives, we invite you to laugh and reflect simultaneously.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="assets/00.jpg" class="lady-img reveal" alt="Lady Painting">
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4 reveal"><h3 class="fw-bold .stats-section">50+</h3><p class="text-uppercase">Exhibitions Held</p></div>
                <div class="col-md-3 mb-4 reveal"><h3 class="fw-bold .stats-section">20+</h3><p class="text-uppercase">Artistic Partners</p></div>
                <div class="col-md-3 mb-4 reveal"><h3 class="fw-bold .stats-section">500+</h3><p class="text-uppercase">Happy Collectors</p></div>
                <div class="col-md-3 mb-4 reveal"><h3 class="fw-bold .stats-section">100+</h3><p class="text-uppercase">Artist Meetings</p></div>
            </div>
        </div>
    </section>

    <div id="gallery" class="col-12 py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5"><h1 class="reveal">Gallery</h1></div>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <div class="col-md-3 col-sm-5 p-3 border border-black rounded text-center reveal" data-bs-toggle="modal" data-bs-target="#galleryModal1" style="cursor:pointer;">
                        <img src="assets/99.jpg" class="w-100 mb-3" alt="Gallery 1"/>
                        <h5>Gallery 1</h5>
                        <p>An expressive piece of contemporary illustration featuring a yellow-faced character with a shocked expression, framed by abstract green and red patterns.</p>
                    </div>
                    <div class="col-md-3 col-sm-5 p-3 border border-black rounded text-center reveal" data-bs-toggle="modal" data-bs-target="#galleryModal2" style="cursor:pointer;">
                        <img src="assets/2.jpg" class="w-100 mb-3" alt="Gallery 2"/>
                        <h5>Gallery 2</h5>
                        <p>A digital reinterpretation of the classic "Self-Portrait" by Joseph Ducreux, capturing a man in 18th-century attire with a dramatic, surprised expression.</p>
                    </div>
                    <div class="col-md-3 col-sm-5 p-3 border border-black rounded text-center reveal" data-bs-toggle="modal" data-bs-target="#galleryModal3" style="cursor:pointer;">
                        <img src="assets/napoleonsucking.jpg" class="w-100 mb-3" alt="Gallery 3"/>
                        <h5>Gallery 3</h5>
                        <p>A parody of classical portraiture featuring a nobleman, humorously modified with the addition of a baby pacifier.</p>
                    </div>
                    <div class="col-md-3 col-sm-5 p-3 border border-black rounded text-center reveal" data-bs-toggle="modal" data-bs-target="#galleryModal4" style="cursor:pointer;">
                        <img src="assets/Greenwell-JohnBrooks-Cloudbusting.webp" class="w-100 mb-3" alt="Gallery 4"/>
                        <h5>Gallery 4</h5>
                        <p>A modern figurative painting showing an individual using a mobile phone, flanked by two large, looming figures that create an introspective atmosphere.</p>
                    </div>
                    <div class="col-md-3 col-sm-5 p-3 border border-black rounded text-center reveal" data-bs-toggle="modal" data-bs-target="#galleryModal5" style="cursor:pointer;">
                        <img src="assets/dummy.jpg" class="w-100 mb-3" alt="Gallery 5"/>
                        <h5>Gallery 5</h5>
                        <p>A realistic illustration depicting a crash test dummy inside a vehicle during an impact, highlighting the dramatic effect of shattered glass.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="galleryModal1" tabindex="-1" aria-labelledby="galleryModalLabel1" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="galleryModalLabel1">Gallery 1</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><img src="assets/99.jpg" class="w-100 mb-3" alt="Gallery 1"/><p>An expressive piece of contemporary illustration featuring a yellow-faced character with a shocked expression, framed by abstract green and red patterns.</p></div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>
    <div class="modal fade" id="galleryModal2" tabindex="-1" aria-labelledby="galleryModalLabel2" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="galleryModalLabel2">Gallery 2</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><img src="assets/2.jpg" class="w-100 mb-3" alt="Gallery 2"/><p>A digital reinterpretation of the classic "Self-Portrait" by Joseph Ducreux, capturing a man in 18th-century attire with a dramatic, surprised expression.</p></div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>
    <div class="modal fade" id="galleryModal3" tabindex="-1" aria-labelledby="galleryModalLabel3" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="galleryModalLabel3">Gallery 3</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><img src="assets/napoleonsucking.jpg" class="w-100 mb-3" alt="Gallery 3"/><p>A parody of classical portraiture featuring a nobleman, humorously modified with the addition of a baby pacifier.</p></div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>
    <div class="modal fade" id="galleryModal4" tabindex="-1" aria-labelledby="galleryModalLabel4" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="galleryModalLabel4">Gallery 4</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><img src="assets/Greenwell-JohnBrooks-Cloudbusting.webp" class="w-100 mb-3" alt="Gallery 4"/><p>A modern figurative painting showing an individual using a mobile phone, flanked by two large, looming figures that create an introspective atmosphere.</p></div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>
    <div class="modal fade" id="galleryModal5" tabindex="-1" aria-labelledby="galleryModalLabel5" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="galleryModalLabel5">Gallery 5</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><img src="assets/dummy.jpg" class="w-100 mb-3" alt="Gallery 5"/><p>A realistic illustration depicting a crash test dummy inside a vehicle during an impact, highlighting the dramatic effect of shattered glass.</p></div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div>

<?php include 'includes/footer.php'; ?>