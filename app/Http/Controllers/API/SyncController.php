<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SyncSession;
use Illuminate\Support\Str;

class SyncController extends Controller
{
    public function store(Request $request)
    {
        // Generate a unique session ID (UUID format)
        $sessionId = Str::uuid()->toString();

        // Create the sync session with default values
        $session = SyncSession::create([
            'session_id' => $sessionId,
            'video_url' => $request->input('videoUrl', ''), // Default to empty string if not provided
            'timestamp' => $request->input('timestamp', 0), // Default to 0
        ]);

        return response()->json([
            'message' => 'Session saved',
            'sessionId' => $sessionId,
        ]);
    }

    public function show($sessionId)
    {
        $session = SyncSession::where('session_id', $sessionId)->first();

        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        return response()->json([
            'videoUrl' => $session->video_url,
            'timestamp' => $session->timestamp,
        ]);
    }

    // (Optional) Update session data
    public function update(Request $request, $sessionId)
    {
        $session = SyncSession::where('session_id', $sessionId)->first();

        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $session->update([
            'video_url' => $request->input('videoUrl', $session->video_url),
            'timestamp' => $request->input('timestamp', $session->timestamp),
        ]);

        return response()->json(['message' => 'Session updated']);
    }
}
