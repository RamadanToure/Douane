@extends('layouts.app')

@section('content')


<div class="auth-page-wrapper pt-5">
    <!-- Auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4">
                        <!-- Logo en cercle -->
                        <div class="logo-circle"></div>
                    </div>
                </div>
            </div>
            <!-- End row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <!-- Tabs navigation -->
                    <div class="step-arrow-nav mt-n3 mx-n3 mb-3">
                        <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true">
                                    <i class="ri-user-2-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i> S'authentifier
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fs-15 p-3" id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false">
                                    <i class="ri-file-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i> Suivre un courrier
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
                                        <h5 class="text-primary">Bienvenue sur {{ config('app.name') }} !</h5>
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
                                                @if (Route::has('password.request'))
                                                    <!-- Uncomment the line below if password reset is available -->
                                                    <!-- <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Mot de passe oublié ?') }}</a> -->
                                                @endif
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
                    <div class="mt-4 text-center">
                        <p class="mb-0 text-white">Vous n'avez pas de compte ?
                            <a href="{{ route('register') }}" class="text-white fw-semibold text-primary text-decoration-underline"> S'inscrire </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center text-white">
                        <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> {{ config('app.name') }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

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
