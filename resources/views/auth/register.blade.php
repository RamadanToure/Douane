@extends('layouts.app')

@section('content')

{{-- <style>
    /* Style pour le wrapper de la page d'authentification */
    .auth-page-wrapper {
        background: url('{{ asset('assets/images/background.jpg') }}') no-repeat center center;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .auth-page-content {
        background: rgba(255, 255, 255, 0.9); /* Fond blanc semi-transparent */
        border-radius: 8px;
        padding: 20px;
        width: 100%;
        max-width: 700px; /* Ajuste la largeur du cadre */
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
    }

    .auth-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
    }

    .logo-left, .logo-right {
        width: 80px;
        height: 80px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .logo-left {
        background-image: url('{{ asset('assets/images/douane.png') }}');
    }

    .logo-right {
        background-image: url('{{ asset('assets/images/douane2.png') }}');
    }

    .text-primary {
        color: blue; /* Couleur bleue pour <h5> */
        margin-bottom: 10px;
    }

    .text-muted {
        color: gray; /* Couleur grise pour le texte */
        margin-bottom: 20px;
    }

    .btn-custom {
        background-color: blue;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
    }

    .btn-custom:hover {
        background-color: darkblue;
    }

    /* Style pour les messages d'erreur */
    .invalid-feedback {
        display: block;
    }

    .form-control {
        width: 100%; /* Champs du formulaire prennent toute la largeur disponible */
    }

    .footer {
        position: absolute;
        bottom: 20px;
        width: 100%;
    }

    .text-center {
        text-align: center;
    }
</style> --}}

<div class="auth-page-wrapper">
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="auth-page-header">
            <div class="logo-left"></div>
            <div class="text-center">
                <h1 class="text-primary">Créer un Compte</h1>
                <h2 class="text-muted">Veuillez remplir les informations ci-dessous</h2>
            </div>
            <div class="logo-right"></div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="matricule" class="form-label">Matricule <span class="text-danger">*</span></label>
                    <input id="matricule" type="text" class="form-control @error('matricule') is-invalid @enderror" name="matricule" value="{{ old('matricule') }}" autocomplete="matricule">
                    @error('matricule')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password-confirm" class="form-label">Confirmer <span class="text-danger">*</span></label>
                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-custom w-100 rounded-pill" type="submit">Créer votre compte</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="mb-0">Vous avez déjà un compte ? <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-underline"> S'authentifier </a></p>
        </div>
    </div>
    <!-- end auth page content -->

    <!-- footer -->
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
    <!-- end Footer -->
</div>

@endsection
