@extends('layouts.app')

@section('content')

<style>
    /* Style pour le wrapper de la page d'authentification */
    .auth-page-wrapper {
        background: url('{{ asset('assets/images/background.jpg') }}') no-repeat center center;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-page-content {
        background: rgba(255, 255, 255, 0.9); /* Fond blanc semi-transparent */
        border-radius: 8px;
        padding: 20px;
        width: 100%;
        max-width: 1200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px solid blue; /* Bordure bleue */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    /* Style pour les logos */
    .logo-left, .logo-right {
        position: absolute;
        top: 50px; /* Ajustez cette valeur si nécessaire */
        width: 100px; /* Ajustez la taille du logo selon vos besoins */
        height: 100px; /* Ajustez la taille du logo selon vos besoins */
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .logo-left {
        left: 20px; /* Position à gauche */
        background-image: url('{{ asset('assets/images/douane.png') }}');
    }

    .logo-right {
        right: 20px; /* Position à droite */
        background-image: url('{{ asset('assets/images/douane2.png') }}'); /* Changez le chemin selon votre image */
    }

    .form-container {
        width: 100%;
    }

    .form-wrapper {
        padding: 20px;
    }

    .register-link {
        text-align: center;
    }

    .text-primary {
        color: blue; /* Couleur bleue pour <h1> */
    }

    .text-dark {
        color: black; /* Couleur noire pour <h2> */
    }

    .slider {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background: url('{{ asset('assets/images/slider1.jpg') }}') no-repeat center center;
        background-size: cover;
        opacity: 0.5;
        z-index: -1;
    }
</style>

<div class="auth-page-wrapper">
    <div class="auth-page-content">
        <!-- Logos positionnés en absolu -->
        <div class="logo-left"></div>
        <div class="logo-right"></div>

        <!-- Conteneur du formulaire -->
        <div class="form-container">
            <div class="form-wrapper">
                <!-- Ajout du titre H1 et H2 -->
                <div class="text-center mb-4">
                    <h1 class="text-primary"><b>BIENVENUE SUR LA PLATEFORME DE GESTION DES ARCHIVES</b></h1>
                    <h2 class="text-dark"><b>Direction Générale des Douanes</b></h2>
                </div>

                <hr>
                <!-- Tabs navigation -->
                <div class="step-arrow-nav mt-n3 mx-n3 mb-3">
                    <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">
                                <i class="ri-user-2-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i> <b>S'authentifier</b>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fs-15 p-3" id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false">
                                <i class="ri-file-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i> <b>Suivre un courrier</b>
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <!-- Login Tab -->
                    <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Veuillez vous identifier pour accéder à {{ config('app.name') }} !</h5>
                                    <p class="text-muted">Connectez-vous</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('E-mail') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-4 text-center">
                                            <button type="submit" class="btn btn-dark w-100 rounded-pill">{{ __('Se connecter') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Login Tab -->

                    <!-- Courrier Tracking Tab -->
                    <div class="tab-pane fade" id="pills-bill-address" role="tabpanel" aria-labelledby="pills-bill-address-tab">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="msgAction text-danger"></div>
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Veuillez renseigner le code de suivi du courrier</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <label for="refCourrier" class="form-label">Code du courrier</label>
                                    <input id="refCourrier" type="text" class="form-control" name="refCourrier" value="{{ old('refCourrier') }}" autocomplete="off" autofocus>
                                    <span class="text-danger" id="refCourrierError"></span>
                                </div>
                                <div class="mt-4 text-center">
                                    <button type="button" id="valider" class="btn btn-success w-100 rounded-pill" onclick="CheckCode();">Vérifier l'évolution du courrier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Courrier Tracking Tab -->
                </div>

                <!-- Registration Link -->
                {{-- <div class="register-link mt-4 text-center">
                    <p class="mb-0">Vous n'avez pas de compte ?
                        <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline"> S'inscrire </a>
                    </p>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> {{ config('app.name') }}.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

@endsection

<script src="{{ url('assets/js/jquery.min.js') }}"></script>
<script>
    function CheckCode() {
        let ref = $('#refCourrier').val();
        if (!ref) return;

        $('#valider').attr("disabled", true);
        $("div.msgAction").html('').hide(200);
        $('#refCourrierError').addClass('d-none');

        $.ajax({
            type: 'GET',
            url: '{{ url("courrier/levelExacution/") }}/' + ref,
            success: function(data) {
                $('#valider').attr("disabled", false);

                if (data.response != 1) {
                    $.each(data.response, function(key, value) {
                        $('#' + key + 'Error').removeClass('d-none').text(value);
                    });
                } else {
                    let alertType = data.fichier ? 'alert-success' : 'alert-warning';
                    $("div.msgAction").html(`<div class="alert ${alertType} alert-border-left alert-dismissible fade show" role="alert">${data.message}${data.fichier || ''}</div>`).show(200);
                }
            },
            error: function() {
                $('#valider').attr("disabled", false);
            }
        });
    }
</script>

