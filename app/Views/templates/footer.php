</main>
    
    <!-- Footer -->
    <footer class="footer mt-auto py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-white mb-3">ITE311-LAYAN</h5>
                    <p class="mb-0">Empowering learners through innovative education technology.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links mb-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                    <p class="mb-0">&copy; <?= date('Y') ?> ITE311-LAYAN. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript for Navigation -->
    <script>
        // Set active navigation link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
        
        // Mobile navigation improvements
        function closeMobileMenu() {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        }
        
        // Close mobile menu when clicking on a link
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    </script>
</body>
</html>
