<?php

namespace App\Http\Controllers;

use App\Models\GraphicDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GraphicDesignController extends Controller
{
    public function index()
    {
        $photos = GraphicDesign::all();
        return view('graphicDesign.index', compact('photos'));
    }

    public function create()
    {
        return view('graphicDesign.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        $photo = new GraphicDesign();
        $photo->title = $request->title;

        if ($request->hasFile('image')) {
            // Store in the public disk under 'GraphicDesign' folder
            $imagePath = $request->file('image')->store('GraphicDesign', 'public');
            $photo->image_path = $imagePath;
        }

        $photo->save();

        return redirect()->route('admin-graphic-design.index')->with('success', 'Photo added successfully!');
    }

    public function show(GraphicDesign $admin_graphic_design)
    {
        return view('graphicDesign.show', compact('admin_graphic_design'));
    }

    public function edit(GraphicDesign $admin_graphic_design)
    {
        return view('graphicDesign.edit', ['photo' => $admin_graphic_design]);
    }

    public function update(Request $request, GraphicDesign $admin_graphic_design)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image',
        ]);

        $admin_graphic_design->title = $request->title;

        if ($request->hasFile('image')) {
            if ($admin_graphic_design->image_path && Storage::disk('public')->exists($admin_graphic_design->image_path)) {
                Storage::disk('public')->delete($admin_graphic_design->image_path);
            }

            $imagePath = $request->file('image')->store('GraphicDesign', 'public');
            $admin_graphic_design->image_path = $imagePath;
        }

        $admin_graphic_design->save();

        return redirect()->route('admin-graphic-design.index')->with('success', 'Photo updated successfully!');
    }

    public function destroy(GraphicDesign $admin_graphic_design)
    {
        if (!empty($admin_graphic_design->image_path) && Storage::disk('public')->exists($admin_graphic_design->image_path)) {
            Storage::disk('public')->delete($admin_graphic_design->image_path);
        }

        $admin_graphic_design->delete();

        return back()->with('success', 'Photo and associated image file deleted successfully!');
    }
}
