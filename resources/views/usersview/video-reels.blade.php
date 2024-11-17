@section('title', 'Video Reels')

@section('content')
<div class="container">
    <h1>Video Reels</h1>
    <div class="row">
        @foreach ($photos as $photo)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ Storage::url($photo->image_path) }}" class="card-img-top" alt="{{ $photo->title }}">
                </div>
            </div>
        @endforeach
    </div>
</div>
