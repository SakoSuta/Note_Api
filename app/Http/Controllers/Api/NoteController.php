<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Note;
use App\Models\User;

class NoteController extends Controller
{
    public function getAllNotes(Request $request)
    {
        $note = Note::orderBy('updated_at', 'desc')->get();

        return response()->json([
            'Result' => $note,
        ], 200);
    }

    
    public function getNotesById(Request $request)
    {
        $note = Note::find($request->id);

        return response()->json([
            'Result' => $note,
        ], 200);
    }

    
    public function createNote(Request $request)
    {
        $user = $request->user();
        $note = Note::create([
            'user_id' => $user->id,
            'content' => $request->content,
        ]);
        
        return response()->json([
            'message' => 'Note created successfully.',
            'note' => $note,
        ], 201);
    }

    
    public function updateNote(Request $request, $id)
    {
        $user = $request->user();

        $note = Note::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();
        
        if (!$note) {
            return response()->json([
                'message' => 'Note not found or unauthorized.',
            ], 404);
        }
        
        $note->content = $request->content;
        $note->save();
        
        return response()->json([
            'message' => 'Note updated successfully.',
            'note' => $note,
        ], 200);
    }

    
    public function deleteNote(Request $request)
    {
        $user = $request->user();

        $note = Note::where('id', $request->id)
                    ->where('user_id', $user->id)
                    ->first();
        
        if (!$note) {
            return response()->json([
                'message' => 'Note not found or unauthorized.',
            ], 404);
        }
        
        $note->delete();
        
        return response()->json([
            'message' => 'Note deleted successfully.',
        ], 200);
    }
}

