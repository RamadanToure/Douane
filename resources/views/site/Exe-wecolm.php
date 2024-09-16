    
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay" style="background-color: #ebeaef;"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active"
                                                            aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1"
                                                            aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2"
                                                            aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Cette plateforme vous permet de ... 1 "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Cette plateforme vous permet de ... 2"</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Cette plateforme vous permet de ... 3 Thanks very much! "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Bienvenue sur {{config('app.name')}} !</h5>
                                            <p class="text-muted">Connectez-vous pour continuer.</p>
                                        </div>
        
                                        <div class="mt-4">
                                            <form action="https://themesbrand.com/velzon/html/default/index.html">
                
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Matricule</label>
                                                    <input type="text" class="form-control" id="username" placeholder="Entrer votre matricule">
                                                </div>
                        
                                                <div class="mb-3">
                                                    <!-- <div class="float-end">
                                                        <a href="auth-pass-reset-cover.html" class="text-muted">Forgot password?</a>
                                                    </div> -->
                                                    <label class="form-label" for="password-input">Mot de passe</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5" placeholder="Enter password" id="password-input">
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Connectez-vous</button>
                                                </div>
            
                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0">Vous n'avez pas de compte ?  <a href="{{ url('registerUsager') }}" class="fw-semibold text-primary text-decoration-underline"> S'inscrire</a> </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0"> {{config('app.name')}} &copy; <script>document.write(new Date().getFullYear())</script></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>