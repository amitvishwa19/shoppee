<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TestRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Test;

class TestController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $tests = Test::orderby('created_at','desc')->latest('id');

            return Datatables::of($tests)
            ->editColumn('created_at',function(Test $test){
                return $test->created_at->diffForHumans();
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('test.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);


        }


        return view('admin.pages.test.test');

    }

    public function create()
    {
        return view('admin.pages.test.test_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $test = New Test;
        $test->name = $request->name;
        $test->save();

        return redirect()->route('test.index')
        ->with([
            'message'    =>'Test Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $test = Test::findOrFail($id);

        return response()->json($test);
    }

    public function edit($id)
    {
        $test = Test::findOrFail($id);

        //return response()->json($test);

        return view('admin.pages.test.test_edit',compact('test'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $test = Test::findOrFail($id);
        $test->name = $request->name;
        $test->save();

        return redirect()->route('test.index')
        ->with([
            'message'    =>'Test Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $test = Test::destroy($id);

        if($test){
            return redirect()->route('test.index')
            ->with([
                'message'    =>'Test Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
