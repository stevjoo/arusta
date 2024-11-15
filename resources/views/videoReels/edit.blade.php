@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Video</h1>
    <form method="POST" action="{{ route('admin-video-reels.update', ['admin_video_reels' => $video->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" required>
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Change Video</label>
            <input type="file" class="form-control" id="video" name="video">
            <video width="320" height="240" controls>
                <source src="{{ Storage::url($video->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
