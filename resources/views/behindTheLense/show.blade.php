@extends('layouts.app')

@section('content')
<div class="container">
    <h1>View Photo</h1>
    <div>
        <h2>{{ $admin_behind_the_lense->title }}</h2>
        <img src="{{ Storage::url($admin_behind_the_lense->image_path) }}" alt="Photo" style="max-width: 100%; height: auto;">
    </div>
    <a href="{{ route('admin-behind-the-lense.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
