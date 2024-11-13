<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>RNG DEV HR</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{url('assets/backend/')}}/images/favicon.ico">

        <link href="{{url('assets/backend/')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{{url('assets/backend/')}}/css/icons.css" rel="stylesheet" type="text/css">
        <link href="{{url('assets/backend/')}}/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <div class="text-center m-b-15">
                        <a href="index.html" class="logo logo-admin"><img src="{{url('assets/backend/')}}/images/logo.png" height="24" alt="logo"></a>
                    </div>

                    <div class="p-3">
                    <form method="POST" action="{{ route('login') }}">
                      @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="scholar_no">Email ID</label>
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
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
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
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-danger btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <!-- jQuery  -->
        <script src="{{url('assets/backend/')}}/js/jquery.min.js"></script>
        <script src="{{url('assets/backend/')}}/js/popper.min.js"></script>
        <script src="{{url('assets/backend/')}}/js/bootstrap.min.js"></script>
        <script src="{{url('assets/backend/')}}/js/modernizr.min.js"></script>
        <script src="{{url('assets/backend/')}}/js/detect.js"></script>
        <script src="{{url('assets/backend/')}}/js/fastclick.js"></script>
        <script src="{{url('assets/backend/')}}/js/jquery.slimscroll.js"></script>
        <script src="{{url('assets/backend/')}}/js/jquery.blockUI.js"></script>
        <script src="{{url('assets/backend/')}}/js/waves.js"></script>
        <script src="{{url('assets/backend/')}}/js/jquery.nicescroll.js"></script>
        <script src="{{url('assets/backend/')}}/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="{{url('assets/backend/')}}/js/app.js"></script>

    </body>
</html>