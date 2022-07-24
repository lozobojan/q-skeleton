@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <div class="content">
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="col-lg-4 offset-1">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="m-0">Author details</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-center table-responsive">

                                        <p class="text-left mb-0"><b>First name:</b> {{ $author->firstName }}</p>
                                        <p class="text-left mb-0"><b>Last name:</b> {{ $author->lastName }}</p>
                                        <p class="text-left mb-0"><b>Birthday:</b> {{ $author->birthday }}</p>
                                        <p class="text-left mb-0"><b>Gender:</b> {{ $author->gender }}</p>
                                        <p class="text-left mb-0"><b>Place of birth:</b> {{ $author->placeOfBirth }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10 offset-1">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="m-0">Books</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-center table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Release date</th>
                                                <th>ISBN</th>
                                                <th>Format</th>
                                                <th>Pages</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($author->books as $book)
                                                <tr>
                                                    <td>{{ $book->title }}</td>
                                                    <td>{{ $book->descriptionTrim }}</td>
                                                    <td>{{ $book->releaseDate }}</td>
                                                    <td>{{ $book->isbn }}</td>
                                                    <td>{{ $book->format }}</td>
                                                    <td>{{ $book->numberOfPages }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
