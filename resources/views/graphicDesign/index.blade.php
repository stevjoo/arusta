@extends('layouts.app')

@section('title', 'Graphic Design')

@section('header')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Graphic Design') }}
            </h2>
        </div>
    </header>
@endsection

@section('content')
<div class="container">
    <h1>Graphic Design</h1>
    <a href="{{ route('admin-graphic-design.create') }}" class="btn btn-primary">Add New Photo</a>
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
                            <a href="{{ route('admin-graphic-design.show', $photo->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('admin-graphic-design.edit', $photo->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('admin-graphic-design.destroy', $photo->id) }}" method="POST" style="display: inline-block;">
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
