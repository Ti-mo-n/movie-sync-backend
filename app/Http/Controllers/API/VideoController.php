<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
   public function upload(Request $request)
{
    $request->validate([
        'video' => 'required|file|mimes:mp4,mov,avi,webm|max:204800' // 200MB
    ]);

    $file = $request->file('video');
    $filename = time() . '_' . $file->getClientOriginalName();
    $path = $file->storeAs('public/videos', $filename); // stores in storage/app/public/videos

   
    $url = Storage::url('videos/' . $filename); // /storage/videos/filename.mp4

    // Save to DB
    $video = Video::create([
        'filename' => $filename,
        'url' => $url,
    ]);

    return response()->json([
        'message' => 'Uploaded successfully',
        'video_url' => asset($url), // full URL: http://your-app/storage/videos/filename.mp4
    ]);
}

public function index()
{
    return response()->json(Video::all());
}


}
