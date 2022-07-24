@extends('layouts.guest')

@section('content')

    <body class="hold-transition login-page">
    <div class="login-box">

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Log in</p>

                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" required placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" required placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 offset-3">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /.login-box -->

    </body>

@endsection
