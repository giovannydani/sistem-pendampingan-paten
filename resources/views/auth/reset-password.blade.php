<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <h1 class="auth-title" style="font-size: 50px">Reset password.</h1>

            <form action="{{ route('password.update') }}" method="POST">
              @csrf
              <div class="form-group position-relative has-icon-left mb-4">
                <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" id="email" value="{{ old('email') }}" autocomplete="off" />
                <div class="form-control-icon">
                    <i class="fa-regular fa-envelope"></i>
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
              <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Re-Password" name="password_confirmation" id="password_confirmation" />
                <input type="hidden" class="form-control form-control-xl" name="token" id="token" value="{{$token}}" />
                <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
                </div>
                @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                Reset
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