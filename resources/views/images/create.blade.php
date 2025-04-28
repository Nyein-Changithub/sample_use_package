@extends('layouts.app')

@section('content')
    <h1>Upload New Image</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Choose Image:</label>
            <input type="file" name="image" id="image" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection
