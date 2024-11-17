<?php

namespace App\Http\Controllers;

use App\Models\VideoReels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoReelsController extends Controller
{
    public function index()
    {
        $videos = VideoReels::all();
        return view('videoReels.index', compact('videos'));
    }

    public function publicIndex()
    {
        $photos = VideoReels::all();
        return view('usersview.video-reels', compact('photos'));
    }

    public function create()
    {
        return view('videoReels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,avi,mov|max:102400',  // Validating video files
        ]);

        $video = new VideoReels();
        $video->title = $request->title;

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('VideoReels', 'public');
            $video->video_path = $videoPath;
        }

        $video->save();

        return redirect()->route('admin-video-reels.index')->with('success', 'Video added successfully!');
    }

    public function show(VideoReels $admin_video_reels)
    {
        return view('videoReels.show', compact('admin_video_reels'));
    }

    public function edit(VideoReels $admin_video_reels)
    {
        return view('videoReels.edit', ['video' => $admin_video_reels]);
    }

    public function update(Request $request, VideoReels $admin_video_reels)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'file|mimes:mp4,avi,mov',  // Validating video files
        ]);

        $admin_video_reels->title = $request->title;

        if ($request->hasFile('video')) {
            if ($admin_video_reels->video_path && Storage::disk('public')->exists($admin_video_reels->video_path)) {
                Storage::disk('public')->delete($admin_video_reels->video_path);
            }
            $videoPath = $request->file('video')->store('VideoReels', 'public');
            $admin_video_reels->video_path = $videoPath;
        }

        $admin_video_reels->save();

        return redirect()->route('admin-video-reels.index')->with('success', 'Video updated successfully!');
    }

    public function destroy(VideoReels $admin_video_reels)
    {
        if (!empty($admin_video_reels->video_path) && Storage::disk('public')->exists($admin_video_reels->video_path)) {
            Storage::disk('public')->delete($admin_video_reels->video_path);
        }

        $admin_video_reels->delete();

        return back()->with('success', 'Video and associated file deleted successfully!');
    }
}
