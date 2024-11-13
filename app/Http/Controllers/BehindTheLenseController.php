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

        return redirect()->route('admin-behind-the-lense.index')->with('success', 'Photo added successfully!');
    }

    public function show(BehindTheLense $admin_behind_the_lense)
    {
        return view('behindTheLense.show', compact('admin_behind_the_lense'));
    }

    public function edit(BehindTheLense $admin_behind_the_lense)
    {
        return view('behindTheLense.edit', ['photo' => $admin_behind_the_lense]);
    }

    public function update(Request $request, BehindTheLense $admin_behind_the_lense)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image',
        ]);

        $admin_behind_the_lense->title = $request->title;

        if ($request->hasFile('image')) {
            if ($admin_behind_the_lense->image_path && Storage::disk('public')->exists($admin_behind_the_lense->image_path)) {
                Storage::disk('public')->delete($admin_behind_the_lense->image_path);
            }

            $imagePath = $request->file('image')->store('BehindTheLense', 'public');
            $admin_behind_the_lense->image_path = $imagePath;
        }

        $admin_behind_the_lense->save();

        return redirect()->route('admin-behind-the-lense.index')->with('success', 'Photo updated successfully!');
    }

    public function destroy(BehindTheLense $admin_behind_the_lense)
    {
        if (!empty($admin_behind_the_lense->image_path) && Storage::disk('public')->exists($admin_behind_the_lense->image_path)) {
            Storage::disk('public')->delete($admin_behind_the_lense->image_path);
        }

        $admin_behind_the_lense->delete();

        return back()->with('success', 'Photo and associated image file deleted successfully!');
    }
}
