<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}" />
    <link
      rel="shortcut icon"
      href="{{ asset('assets/images/logo/favicon.svg') }} "
      type="image/x-icon"
    />
    <link
      rel="shortcut icon"
      href="{{ asset('assets/images/logo/favicon.png') }}"
      type="image/png"
    />
  </head>

  <body>
    <div id="auth">
      <div class="row h-100">
        <div class="col-lg-5 col-12">
          <div id="auth-left">
            <h1 class="auth-title" style="font-size: 50px">Forgot password.</h1>

            @if (session('status'))
            <div class="alert alert-success my-5" role="alert">
              {{session('status')}}
            </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" id="name" value="{{ old('email') }}" autocomplete="off"/>
                    <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                    </div>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                    Submit
                </button>
            </form>
            <div class="text-center mt-5" style="font-size: 20px">
              <p class="text-gray-600">
                Have an account?
                <a href="{{ route('auth.login.index') }}" class="font-bold">Sign in</a>
              </p>
              <p class="text-gray-600">
                Don't have an account?
                <a href="{{ route('auth.register.index') }}" class="font-bold">Sign up</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
          <div id="auth-right"></div>
        </div>
      </div>
    </div>
  </body>
</html>