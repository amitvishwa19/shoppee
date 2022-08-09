<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Tag;

class TagController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $tags = Tag::orderby('created_at','desc')->latest('id');

            return Datatables::of($tags)
            ->editColumn('created_at',function(Tag $tag){
                return $tag->created_at->diffForHumans();
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('tag.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);


        }


        return view('admin.pages.tag.tag');

    }

    public function create()
    {
        return view('admin.pages.tag.tag_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $tag = New Tag;
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tag.index')
        ->with([
            'message'    =>'Tag Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $tag = Tag::findOrFail($id);

        return response()->json($tag);
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        //return response()->json($tag);

        return view('admin.pages.tag.tag_edit',compact('tag'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tag.index')
        ->with([
            'message'    =>'Tag Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $tag = Tag::destroy($id);

        if($tag){
            return redirect()->route('tag.index')
            ->with([
                'message'    =>'Tag Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
