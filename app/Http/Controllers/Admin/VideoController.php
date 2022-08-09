<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Video;

class VideoController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $videos = Video::orderby('created_at','desc')->latest('id');

            return Datatables::of($videos)
            ->editColumn('created_at',function(Video $video){
                    return $video->created_at->diffForHumans();
                })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('video.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);


        }


        return view('admin.pages.video.video');

    }

    public function create()
    {
        return view('admin.pages.video.video_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $video = New Video;
        $video->name = $request->name;
        $video->save();

        return redirect()->route('video.index')
        ->with([
            'message'    =>'Video Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $video = Video::findOrFail($id);

        return response()->json($video);
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);

        //return response()->json($video);

        return view('admin.pages.video.video_edit',compact('video'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $video = Video::findOrFail($id);
        $video->name = $request->name;
        $video->save();

        return redirect()->route('video.index')
        ->with([
            'message'    =>'Video Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $video = Video::destroy($id);

        if($video){
            return redirect()->route('video.index')
            ->with([
                'message'    =>'Video Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
