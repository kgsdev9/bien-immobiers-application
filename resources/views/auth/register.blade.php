<!DOCTYPE html>
<html lang="fr">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>Restaurateur 2.0 - Simplifiez la Gestion de Votre Restaurant</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="Découvrez Restaurateur 2.0, l'application révolutionnaire pour optimiser la gestion et le suivi de votre restaurant. Simplifiez vos opérations, améliorez vos services et développez votre activité." />
    <meta name="keywords"
        content="restaurant, gestion restaurant, application restaurant, suivi commandes, facturation restaurant, optimisation services, technologie de restauration" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Restaurateur 2.0 - La Technologie au Service de Votre Restaurant" />
    <meta property="og:url" content="https://votre-application-restaurant.com" />
    <meta property="og:site_name" content="Restaurateur 2.0" />
    <link rel="canonical" href="https://votre-application-restaurant.com" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank app-blank">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center"
                style="background-image:url({{ asset('auth-bg.png') }})">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
                    <!--begin::Logo-->
                    <a href="#" class="mb-0 mb-lg-20">
                        <img alt="Logo" src="{{ asset('avatar.png') }}" class="h-40px h-lg-50px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20"
                        src="assets/media/misc/auth-screens.png" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">
                        Simplifiez la gestion de votre restaurant avec innovation et efficacité
                    </h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-white fs-base text-center">
                        Découvrez comment notre application transforme la gestion de votre restaurant.
                        <a href="#" class="opacity-75-hover text-warning fw-semibold me-1">Restaurateur 2.0</a>
                        vous aide à gérer les commandes, suivre vos factures et optimiser vos opérations.
                        <br />Une expérience intuitive et des fonctionnalités innovantes pour un service amélioré.
                        <br />Commencez dès aujourd'hui à propulser votre restaurant vers de nouveaux sommets.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10">
                        <form class="form w-100" novalidate="novalidate" method="POST"
                            action="{{ route('register') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Gérez votre restaurant efficacement</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Suivez vos commandes, factures et opérations
                                    en temps réel</div>
                            </div>
                            <!--end::Heading-->
                            <!-- User Name -->
                            <div class="fv-row mb-8 form-floating">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="name" class="form-label">Nom d'utilisateur</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Email -->
                            <div class="fv-row mb-8 form-floating">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="email" class="form-label">Email</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password -->
                            <div class="fv-row mb-8 form-floating" data-kt-password-meter="true">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                <label for="password" class="form-label">Mot de passe</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Confirm Password -->
                            <div class="fv-row mb-8 form-floating">
                                <input id="password_confirmation" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="current-password">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de
                                    passe</label>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Submit -->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Inscription</span>
                                </button>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6">Vous avez déjà un compte ?
                                <a href="{{ route('login') }}" class="link-primary fw-semibold">Connectez-vous</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
</body>

</html>
