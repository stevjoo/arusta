@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Behind The Lens</h1>
    <a href="{{ route('behind-the-lense.create') }}" class="btn btn-primary">Add New Photo</a>
    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($photos as $photo)
                    <tr>
                        <th scope="row">{{ $photo->id }}</th>
                        <td>{{ $photo->title }}</td>
                        <td><img src="{{ Storage::url($photo->image_path) }}" alt="Photo" width="100"></td>
                        <td>
                            <a href="{{ route('behind-the-lense.show', $photo->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('behind-the-lense.edit', $photo->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('behind-the-lense.destroy', $photo->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this photo?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
