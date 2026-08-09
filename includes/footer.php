<div>
        <button id="myBtn" aria-label="Scroll to top">↑</button>
    </div>

<footer class="py-5 mt-auto border-top border-secondary" style="background-color: #000000; color: #ffffff;">
    <div class="container text-decoration-none">
        <div class="row justify-content-between gy-5">
            
            <!-- Explore -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <h6 class="fw-bold mb-3 text-white" style="letter-spacing: 0.5px;">Explore</h6>
                <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                    <li><a href="index.php" class="text-white-50 text-decoration-none transition-all">Home</a></li>
                    <li><a href="gallery.php" class="text-white-50 text-decoration-none transition-all">Gallery</a></li>
                    <li><a href="history.php" class="text-white-50 text-decoration-none transition-all">History</a></li>
                    <li><a href="vm.php" class="text-white-50 text-decoration-none transition-all">Vision & Mission</a></li>
                    <li><a href="contact.php" class="text-white-50 text-decoration-none transition-all">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <h6 class="fw-bold mb-3 text-white" style="letter-spacing: 0.5px;">Contact Info</h6>
                <address class="list-unstyled mb-0 d-flex flex-column gap-2 text-white-50 text-decoration-none fst-normal" style="font-size: 0.95rem;">
                    <span><i class="fa-solid fa-location-dot me-2"></i> Jakarta, Indonesia</span>
                    <span><i class="fa-solid fa-phone me-2"></i> <a href="tel:+622155551234" class="text-white-50 text-decoration-none transition-all">+62 21 5555 1234</a></span>
                    <span><i class="fa-solid fa-envelope me-2"></i> <a href="mailto:hello@gallerymockers.com" class="text-white-50 text-decoration-none transition-all">hello@gallerymockers.com</a></span>
                </address>
            </div>

            <!-- Embedded Google Maps (Di antara Contact Info dan Follow Us) -->
            <div class="col-lg-3 col-md-4 col-sm-12">
                <h6 class="fw-bold mb-3 text-white" style="letter-spacing: 0.5px;">Our Location</h6>
                <div class="contact-map rounded overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8315923724517!2d106.80230338383926!3d-6.285855545272794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1f1c3e14ed7%3A0xeb89ef266f79a39c!2sJl.%20Pangeran%20Antasari%2C%20RT.12%2FRW.13%2C%20Cilandak%20Bar.%2C%20Kec.%20Cilandak%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012430!5e0!3m2!1sid!2sid!4v1783665112661!5m2!1sid!2sid" title="Location Gallery Mockers" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="width: 100%; height: 150px; border: 0;"></iframe>
                </div>
            </div>

            <!-- Follow us & Newsletter -->
            <div class="col-lg-3 col-md-12 d-flex flex-column gap-4">
                <div>
                    <h6 class="fw-bold mb-3 text-white" style="letter-spacing: 0.5px;">Follow us</h6>
                    <div class="d-flex align-items-center gap-3">
                        <a href="https://facebook.com" aria-label="Visit our Facebook page" class="text-white fs-5 transition-all"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://linkedin.com" aria-label="Visit our LinkedIn page" class="text-white fs-5 transition-all"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://instagram.com" aria-label="Visit our Instagram page" class="text-white fs-5 transition-all"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold mb-3 text-white" style="letter-spacing: 0.5px;">Want to join us?</h6>
                    <form id="joinForm" class="d-flex gap-2" novalidate>
                        <input type="email" name="email" aria-label="Email address for newsletter" class="form-control flex-grow-1 rounded-pill px-4 py-2 border-0" placeholder="your@email.com" required style="max-width: 250px;">
                        <button type="submit" aria-label="Subscribe to newsletter" class="btn btn-outline-light rounded-pill px-4 py-2 fw-medium transition-all">Join</button>
                    </form>
                    <div id="joinMsg" class="mt-2 text-success small" style="display: none;" aria-live="polite"></div>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-12">
                <p class="mb-0">&copy; <?php echo date("Y"); ?> Gallery Mockers. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/reveal.js"></script>
<script src="js/main.js"></script>
</body>
</html>