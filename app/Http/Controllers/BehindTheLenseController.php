<?php

// app/Http/Controllers/BehindTheLenseController.php

namespace App\Http\Controllers;

use App\Models\BehindTheLense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BehindTheLenseController extends Controller
{
    public function index()
    {
        $photos = BehindTheLense::all();
        return view('behindTheLense.index', compact('photos'));
    }

    public function create()
    {
        return view('behindTheLense.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image',
    ]);

    $photo = new BehindTheLense();
    $photo->title = $request->title;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $photo->image_path = $imagePath;
    }

    $photo->save();

    return redirect()->route('behind-the-lense.index');
}


    public function show(BehindTheLense $photo)
    {
        return view('behindTheLense.show', compact('photo'));
    }

    public function edit(BehindTheLense $photo)
    {
        return view('behindTheLense.edit', compact('photo'));
    }

    public function update(Request $request, BehindTheLense $behind_the_lense)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'image',  // Notice 'image' is not required here
    ]);

    $behind_the_lense->title = $request->title;

    if ($request->hasFile('image')) {
        if ($behind_the_lense->image_path && Storage::disk('public')->exists($behind_the_lense->image_path)) {
            Storage::disk('public')->delete($behind_the_lense->image_path);
        }

        $imagePath = $request->file('image')->store('images', 'public');
        $behind_the_lense->image_path = $imagePath;
    }

    $behind_the_lense->save();

    return redirect()->route('behind-the-lense.index');
}



    public function destroy(BehindTheLense $photo)
    {
        Storage::delete($photo->image_path);
        $photo->delete();

        return back();
    }
}
