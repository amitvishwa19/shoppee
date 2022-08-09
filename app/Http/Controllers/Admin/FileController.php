<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\File;

class FileController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $files = File::orderby('created_at','desc')->latest('id');

            return Datatables::of($files)
            ->editColumn('created_at',function(File $file){
                return $file->created_at->diffForHumans();
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('file.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);


        }


        return view('admin.pages.file.file');

    }

    public function create()
    {
        return view('admin.pages.file.file_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $file = New File;
        $file->name = $request->name;
        $file->save();

        return redirect()->route('file.index')
        ->with([
            'message'    =>'File Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $file = File::findOrFail($id);

        return response()->json($file);
    }

    public function edit($id)
    {
        $file = File::findOrFail($id);

        //return response()->json($file);

        return view('admin.pages.file.file_edit',compact('file'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $file = File::findOrFail($id);
        $file->name = $request->name;
        $file->save();

        return redirect()->route('file.index')
        ->with([
            'message'    =>'File Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $file = File::destroy($id);

        if($file){
            return redirect()->route('file.index')
            ->with([
                'message'    =>'File Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
