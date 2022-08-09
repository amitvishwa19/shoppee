<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NoteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Note;

class NoteController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $notes = Note::orderby('created_at','desc')->latest('id');

            return Datatables::of($notes)
            ->editColumn('created_at',function(Note $note){
                return $note->created_at->diffForHumans();
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('note.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);


        }


        return view('admin.pages.note.note');

    }

    public function create()
    {
        return view('admin.pages.note.note_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $note = New Note;
        $note->name = $request->name;
        $note->save();

        return redirect()->route('note.index')
        ->with([
            'message'    =>'Note Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $note = Note::findOrFail($id);

        return response()->json($note);
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);

        //return response()->json($note);

        return view('admin.pages.note.note_edit',compact('note'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $note = Note::findOrFail($id);
        $note->name = $request->name;
        $note->save();

        return redirect()->route('note.index')
        ->with([
            'message'    =>'Note Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $note = Note::destroy($id);

        if($note){
            return redirect()->route('note.index')
            ->with([
                'message'    =>'Note Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
