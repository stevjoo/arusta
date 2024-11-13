@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Photo</h1>
    <form method="POST" action="{{ route('behind-the-lense.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Photo</button>
    </form>
</div>
@endsection
