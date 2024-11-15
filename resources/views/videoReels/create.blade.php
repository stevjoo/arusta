@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Video</h1>
    <form method="POST" action="{{ route('admin-video-reels.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Upload Video</label>
            <input type="file" class="form-control" id="video" name="video" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Video</button>
    </form>
</div>
@endsection
