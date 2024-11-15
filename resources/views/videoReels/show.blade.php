@extends('layouts.app')

@section('content')
<div class="container">
    <h1>View Video</h1>
    <div>
        <h2>{{ $admin_video_reels->title }}</h2>
        <video width="100%" height="auto" controls>
            <source src="{{ Storage::url($admin_video_reels->video_path) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <a href="{{ route('admin-video-reels.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
