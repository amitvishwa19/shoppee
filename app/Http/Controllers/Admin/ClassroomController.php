<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chapter;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;

class ClassroomController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $classrooms = Classroom::orderby('order','asc')->latest('id');

            return Datatables::of($classrooms)
            ->editColumn('created_at',function(Classroom $classroom){
                return $classroom->created_at->diffForHumans();
            })
            ->addColumn('user',function(Classroom $classroom){
                return $classroom->user->firstName . ',' . $classroom->user->lastName;
            })
            ->addColumn('chapters',function(Classroom $classroom){
                return $classroom->chapters->count();
            })
            ->addColumn('chapters_show',function(Classroom $classroom){
                $chapters = $classroom->chapters;
                $chap = '';
                if($chapters){
                    foreach($chapters as $chapter){
                       $chap = $chap. '<a href="'.route('chapter.show',$chapter->id).'"><div class="badge badge-info mr-1" >'. $chapter->name .'</div></a>';
                    };
                }
                return $chap;
            })
            ->addColumn('status',function(Classroom $classroom){
                if($classroom->status == true){
                    return '<div class="badge badge-success">Active</div>';
                }else{
                    return '<div class="badge badge-warning">InActive</div>';
                }
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('classroom.edit',$data->id).'" class="mr-2"><small><b>Edit</b></small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small><b>Delete</b></small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','status','user','chapters','chapters_show'])
            ->make(true);
        }


        return view('admin.pages.classroom.classroom');

    }

    public function create()
    {
        $chapters = Chapter::where('status',true)->orderby('order','asc')->get();
        return view('admin.pages.classroom.classroom_add')->with('chapters',$chapters);
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $classroom = New Classroom;
        $classroom->user_id = auth()->user()->id;
        $classroom->name = $request->name;
        $classroom->description = $request->description;
        $classroom->overview = $request->overview;
        $classroom->status = $request->status;
        $classroom->save();

        if($request->chapters){
            $classroom->chapters()->sync($request->chapters);
        }

        return redirect()->route('classroom.index')
        ->with([
            'message'    =>'Classroom Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);

        return response()->json($classroom);
    }

    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        $chapters = Chapter::where('status',true)->orderby('order','asc')->get();
        //return response()->json($classroom);

        return view('admin.pages.classroom.classroom_edit')->with('classroom',$classroom)->with('chapters',$chapters);
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->name = $request->name;
        $classroom->description = $request->description;
        $classroom->overview = $request->overview;
        $classroom->status = $request->status;
        $classroom->save();

        if($request->chapters){
            $classroom->chapters()->sync($request->chapters);
        }

        return redirect()->route('classroom.index')
        ->with([
            'message'    =>'Classroom Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $classroom = Classroom::destroy($id);

        if($classroom){
            return redirect()->route('classroom.index')
            ->with([
                'message'    =>'Classroom Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
