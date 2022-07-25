@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <div class="content">
            <div class="container-fluid pt-5">
                <div class="row">
                    <div class="col-lg-10 offset-1">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="m-0">Create a new book</h5>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('books.save') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="authorId">Author:</label>
                                            <select name="authorId" id="authorId" class="form-control" required>
                                                <option value="">- select an author -</option>
                                                @foreach($authors as $author)
                                                    <option value="{{ $author->id }}">{{ $author->fullName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="title">Title:</label>
                                            <input type="text" name="title" id="title" placeholder="Title" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-3">
                                            <label for="releaseDate">Release date:</label>
                                            <input type="date" name="releaseDate" id="releaseDate" placeholder="Release date" class="form-control" required>
                                        </div>
                                        <div class="col-3">
                                            <label for="isbn">ISBN:</label>
                                            <input type="text" name="isbn" id="isbn" placeholder="ISBN" class="form-control" required>
                                        </div>
                                        <div class="col-3">
                                            <label for="format">Format:</label>
                                            <input type="text" name="format" id="format" placeholder="Format" class="form-control" required>
                                        </div>
                                        <div class="col-3">
                                            <label for="numberOfPages">Number of pages:</label>
                                            <input type="number" name="numberOfPages" id="numberOfPages" placeholder="Number of pages" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="description">Description:</label>
                                            <textarea type="date" name="description" id="description" placeholder="Description" class="form-control" required rows="4"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-4 offset-4">
                                            <button class="btn btn-success btn-block">SAVE</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
