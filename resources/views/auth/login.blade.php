<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank BPR Jatim | Log In</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('') }}img/logo/logo-bpr2.png" type="image/x-icon">
  <!-- Custom styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('') }}css/style.min.css">
</head>

<body>
  <div class="layer"></div>
<main class="page-center">
    <article class="sign-up">
        <h1 class="sign-up__title">Selamat datang.</h1>
        <p class="sign-up__subtitle">Silahkan login terlebih dahulu</p>
        <img src="{{ asset('img/logo/logo-bpr2.png') }}" style="margin-bottom: 10px" alt="">
        

        <form class="sign-up-form form" method="POST" action="{{ route('login') }}">
            <!-- Session Status -->
            @if ($errors->any())
                
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                {{$error}}
                            </div>
                        </div>
                        @endforeach
            @endif
            
            
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
            @csrf
            <label class="form-label-wrapper">
                <p class="form-label">Email</p>
                <input class="form-input" name="email" type="email" placeholder="Email" value="{{old('email')}}" required autofocus>
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Password</p>
                <input class="form-input" name="password" type="password" placeholder="Enter your password" required>
            </label>
            {{-- <a class="link-info forget-link" href="##">Forgot your password?</a>
            <label class="form-checkbox-wrapper">
                <input class="form-checkbox" type="checkbox" required>
                <span class="form-checkbox-label">Remember me next time</span>
            </label> --}}
            <button type="submit" class="form-btn primary-default-btn transparent-btn">Sign in</button>
        </form>
    </article>
</main>
<!-- Chart library -->
<script src="{{ asset('') }}plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="{{ asset('') }}plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('') }}js/script.js"></script>
</body>

</html>