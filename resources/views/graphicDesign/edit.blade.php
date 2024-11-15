@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Photo</h1>
    <form method="POST" action="{{ route('admin-graphic-design.update', ['admin_graphic_design' => $photo->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $photo->title }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Change Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ Storage::url($photo->image_path) }}" alt="Current Photo" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
