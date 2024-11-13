@extends('layouts.app')

@section('content')
<div class="container">
    <h1>View Photo</h1>
    <div>
        <h2>{{ $admin_photography->title }}</h2>
        <img src="{{ Storage::url($admin_photography->image_path) }}" alt="Photo" style="max-width: 100%; height: auto;">
    </div>
    <a href="{{ route('admin-photography.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
