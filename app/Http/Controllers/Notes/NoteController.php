<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    //
    public function index(){
        $note =  Note::with('subject')->latest()->get();
        return NoteResource::collection($note);
    }
    public function show(Subject $subject,Note $note){
        return new NoteResource($note);
    }
    public function store(){
        sleep(1);
        request()->validate([
            'subject_id'=>['required'],
            'title'=>['required'],
            'description'=>['required']
        ]);
        $subject = Subject::findOrFail(request('subject_id'));
        $note = Note::create([
            'subject_id'=>$subject->id,
            'title'=>request('title'),
            'slug'=>\Str::slug(request('title')),
            'description'=>request('description')

        ]);
        return response()->json([
            'message'=>'Note Berhasil Di Buat',
            'note'=>$note
        ]);
    }
    public function update(Note $note, Request $request){
        request()->validate([
            'subject_id'=>['required'],
            'title'=>['required'],
            'description'=>['required']
        ]);
        $subject = Subject::findOrFail(request('subject_id'));
        $note->update([
            'title'=>request('title'),
            'subject_id'=>$subject->id,
            // 'slug'=>\Str::slug(request('title')),
            'description'=>request('description')
        ]);
        return response()->json([
            'message'=>'Note Berhasil Di Ubah',
            'note'=>$note
        ]);
    }
    public function destroy(Note $note){
        
        $note->delete();
        return response()->json([
            'message'=>'Note Berhasil Dihapus'
        ],200);
    }
}
