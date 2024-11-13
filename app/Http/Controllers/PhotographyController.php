<?php

namespace App\Http\Controllers;

use App\Models\Photography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotographyController extends Controller
{
    public function index()
    {
        $photos = Photography::all();
        return view('photography.index', compact('photos'));
    }

    public function create()
    {
        return view('photography.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        $photo = new Photography();
        $photo->title = $request->title;

        if ($request->hasFile('image')) {
            // Store in the public disk under 'Photography' folder
            $imagePath = $request->file('image')->store('Photography', 'public');
            $photo->image_path = $imagePath;
        }

        $photo->save();

        return redirect()->route('admin-photography.index')->with('success', 'Photo added successfully!');
    }

    public function show(Photography $admin_photography)
    {
        return view('photography.show', compact('admin_photography'));
    }

    public function edit(Photography $admin_photography)
    {
        return view('photography.edit', ['photo' => $admin_photography]);
    }

    public function update(Request $request, Photography $admin_photography)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image',
        ]);

        $admin_photography->title = $request->title;

        if ($request->hasFile('image')) {
            if ($admin_photography->image_path && Storage::disk('public')->exists($admin_photography->image_path)) {
                Storage::disk('public')->delete($admin_photography->image_path);
            }

            $imagePath = $request->file('image')->store('Photography', 'public');
            $admin_photography->image_path = $imagePath;
        }

        $admin_photography->save();

        return redirect()->route('admin-photography.index')->with('success', 'Photo updated successfully!');
    }

    public function destroy(Photography $admin_photography)
    {
        if (!empty($admin_photography->image_path) && Storage::disk('public')->exists($admin_photography->image_path)) {
            Storage::disk('public')->delete($admin_photography->image_path);
        }

        $admin_photography->delete();

        return back()->with('success', 'Photo and associated image file deleted successfully!');
    }
}
