<?php

namespace App\Http\Controllers;

use App\Models\FeedbackMessage;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FeedbackMessageController extends Controller
{

    public function getAllFeedbackMessages()
    {
        $messages = FeedbackMessage::orderByDesc('updated_at')->get();

        if ($messages->isEmpty()) {
            return response()->json([
                'message' => 'No feedback messages found.'
            ], 200);
        }

        return response()->json([
            'feedback_messages' => $messages
        ], 200);
    }

    public function storeFeedbackMessage(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:feedback_messages,email',
                'message' => 'required|string',
            ], [
                'email.unique' => 'This email has already been used. Please use a different one.',
            ]);

            $message = FeedbackMessage::create($validated);

            return response()->json([
                'data' => $message
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
