<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login SSO UMS</title>
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
            <h1 class="auth-title" style="font-size: 50px">Log in.</h1>

            @if (session('status'))
            <div class="alert alert-success my-5" role="alert">
              {{session('status')}}
            </div>
            @endif

            <form action="{{ route('auth.login.store') }}" method="POST">
              @csrf
              <div class="form-group position-relative has-icon-left mb-4">
                <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" id="name" value="{{ old('email') }}"/>
                <div class="form-control-icon">
                  <i class="bi bi-person"></i>
                </div>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" id="password" />
                <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
                </div>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="form-check form-check-lg d-flex align-items-end">
                <input class="form-check-input me-2" type="checkbox" id="flexCheckDefault" name="remember" id="remember" />
                <label class="form-check-label text-gray-600" for="flexCheckDefault" >
                  Keep me logged in
                </label>
              </div>
              <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                Log in
              </button>
            </form>
          </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
          <div id="auth-right"></div>
        </div>
      </div>
    </div>
  </body>
</html>