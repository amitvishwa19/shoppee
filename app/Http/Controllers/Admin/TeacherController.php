<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;

class TeacherController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $teachers = User::orderby('created_at','desc')->where('type','teacher')->latest('id');

            return Datatables::of($teachers)
            ->editColumn('created_at',function(User $user){
                return $user->created_at->diffForHumans();
            })
            ->addColumn('name',function(User $user){
                return ucfirst($user->firstName) .','. ucfirst($user->lastName);
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('teacher.edit',$data->id).'" class=" mr-2"><small><b>Edit</b></small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small><b>Delete</b></small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);


        }


        return view('admin.pages.teacher.teacher');

    }

    public function create()
    {
        return view('admin.pages.teacher.teacher_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $teacher = New Teacher;
        $teacher->name = $request->name;
        $teacher->save();

        return redirect()->route('teacher.index')
        ->with([
            'message'    =>'Teacher Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return response()->json($teacher);
    }

    public function edit($id)
    {
        $teacher = User::findOrFail($id);

        //return response()->json($teacher);

        return view('admin.pages.teacher.teacher_edit',compact('teacher'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $teacher = User::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->save();

        return redirect()->route('teacher.index')
        ->with([
            'message'    =>'Teacher Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $teacher = Teacher::destroy($id);

        if($teacher){
            return redirect()->route('teacher.index')
            ->with([
                'message'    =>'Teacher Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
