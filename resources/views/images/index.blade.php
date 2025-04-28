@extends('layouts.app')

@section('content')
    <h1>Images List</h1>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row mt-5">
        @if(!empty($images))
            @foreach ($images as $image)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="{{ $image['variants'][0] }}" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <form method="POST" action="{{ route('images.destroy', $image['id']) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No images found.</p>
        @endif
    </div>
@endsection
