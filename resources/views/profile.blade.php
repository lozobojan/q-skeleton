@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <div class="content">
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">Dashboard</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h4>Welcome, {{ $user->first_name." ".$user->last_name }}</h4>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6 offset-3">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-block">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
