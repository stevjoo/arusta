<?php

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
            // Store in the public disk under 'BehindTheLense' folder
            $imagePath = $request->file('image')->store('BehindTheLense', 'public');
            $photo->image_path = $imagePath;
        }

        $photo->save();

        return redirect()->route('behind-the-lense.index')->with('success', 'Photo added successfully!');
    }

    public function show(BehindTheLense $photo)
    {
        return view('behindTheLense.show', compact('photo'));
    }

    public function edit(BehindTheLense $behind_the_lense)
{
    return view('behindTheLense.edit', ['photo' => $behind_the_lense]);
}

public function update(Request $request, BehindTheLense $behind_the_lense)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'image',
    ]);

    $behind_the_lense->title = $request->title;

    if ($request->hasFile('image')) {
        if ($behind_the_lense->image_path && Storage::disk('public')->exists($behind_the_lense->image_path)) {
            Storage::disk('public')->delete($behind_the_lense->image_path);
        }

        $imagePath = $request->file('image')->store('BehindTheLense', 'public');
        $behind_the_lense->image_path = $imagePath;
    }

    $behind_the_lense->save();

    return redirect()->route('behind-the-lense.index')->with('success', 'Photo updated successfully!');
}


    public function destroy(BehindTheLense $photo)
{
    // Check if image path exists and if file exists in the storage
    if (!empty($photo->image_path) && Storage::disk('public')->exists($photo->image_path)) {
        // Attempt to delete the image file
        Storage::disk('public')->delete($photo->image_path);
    }

    // Delete the photo record from the database
    $photo->delete();

    // Redirect back with a success message
    return back()->with('success', 'Photo and associated image file deleted successfully!');
}


}
