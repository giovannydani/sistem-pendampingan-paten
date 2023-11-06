<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
            <h1 class="auth-title" style="font-size: 50px">Register.</h1>

            <form action="{{ route('auth.register.store') }}" method="POST">
              @csrf
              <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" placeholder="Name" name="name" id="name" pattern="[A-Za-z]+" value="{{ old('name') }}" title="Only alphabet characters are allowed." autocomplete="off" />
                <div class="form-control-icon">
                  <i class="bi bi-person"></i>
                </div>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
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
                <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
                </div>
                @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                Register
              </button>
            </form>
            <div class="text-center mt-5" style="font-size: 20px">
              <p class="text-gray-600">
                Already have an account?
                <a href="{{ route('auth.login.index') }}" class="font-bold">Sign in</a>
              </p>
              <p>
                <a class="font-bold" href="{{route('password.request')}}">
                    Forgot password?
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
          <div id="auth-right"></div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        const nameInput = $('#name');

        console.log(nameInput.val());

        nameInput.on('input', function() {
            const inputText = nameInput.val();
            const newText = inputText.replace(/[^A-Za-z]/g, '');

            if (inputText !== newText) {
                nameInput.val(newText);
            }
        });
      })
    </script>
  </body>
</html>