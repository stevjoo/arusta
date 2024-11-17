@extends('layouts.app')

@section('title', 'Video Reels')

@section('header')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Video Reels') }}
            </h2>
        </div>
    </header>
@endsection

@section('content')
<div class="container">
    <h1>Video Reels</h1>
    <a href="{{ route('admin-video-reels.create') }}" class="btn btn-primary">Add New Video</a>
    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Video</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <th scope="row">{{ $video->id }}</th>
                        <td>{{ $video->title }}</td>
                        <td>
                            <video width="100" controls>
                                <source src="{{ Storage::url($video->video_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </td>
                        <td>
                            <a href="{{ route('admin-video-reels.show', $video->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('admin-video-reels.edit', $video->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('admin-video-reels.destroy', $video->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this video?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
