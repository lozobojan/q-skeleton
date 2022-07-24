@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <div class="content">
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="col-lg-10 offset-1">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="m-0">Authors</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-center table-responsive">

                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Full name</th>
                                                    <th>Birthday</th>
                                                    <th>Gender</th>
                                                    <th>Place of birth</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($authors as $author)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('authors.show', ['id' => $author->id]) }}">{{ $author->fullName }}</a>
                                                        </td>
                                                        <td>{{ $author->birthday }}</td>
                                                        <td>{{ $author->genderAbbr }}</td>
                                                        <td>{{ $author->placeOfBirth }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        @include('partials.pagination')
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
