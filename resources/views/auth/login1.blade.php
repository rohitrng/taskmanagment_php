
<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Lokmanya Vidya Niketan</title>
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900"
    rel="stylesheet"
  />
  <link
    href="{{url('assets/backend/')}}/css/themes/lite-purple.min.css"
    rel="stylesheet"
  />
</head>
<div
  class="auth-layout-wrap"
  style="background-image: url({{url('assets/backend/')}}/images/lvn-bg.jpg)"
>
  <div class="auth-content">
    <div class="card o-hidden">
      <div class="row">
        <div class="col-md-6">
          <div class="p-4">
            <div class="auth-logo text-center mb-4" style="width:270px;height:65px;" >
              <img src="{{url('assets/backend/')}}/images/header-logo (1).png" alt="" style="width:100%; height: 65px;" />
            </div>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="scholar_no">User ID</label>
                <input id="scholar_no" 
                type="text" 
                class="form-control form-control-rounded @error('scholar_no') is-invalid @enderror" 
                name="scholar_no" 
                value="{{ old('scholar_no') }}" 
                required 
                autocomplete="scholar_no" 
                autofocus>

                @error('scholar_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input id="password" 
                type="password" 
                class="form-control form-control-rounded @error('password') is-invalid @enderror" 
                name="password" 
                required 
                autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <button class="btn btn-rounded btn-primary w-100 mt-2">
                Sign In
              </button>
            </form>
            <div class="mt-3 text-center">
            @if (Route::has('password.request'))
                <!-- <a class="text-muted" href="{{ route('password.request') }}"> -->
                  <a class="text-muted" href="#">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
            </div>
          </div>
        </div>
        <div
          class="col-md-6 text-center">
            <img src="{{url('assets/backend/')}}/images/lvn-images.jpg" alt="" style="width:100%;"/>
        </div>
      </div>
    </div>
  </div>
</div>
