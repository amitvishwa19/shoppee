<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;

class ChapterController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $chapters = Chapter::orderby('order','asc')->latest('id');

            return Datatables::of($chapters)
            ->editColumn('created_at',function(Chapter $chapter){
                return $chapter->created_at->diffForHumans();
            })
            ->addColumn('user',function(Chapter $chapter){
                return $chapter->user->firstName . ',' . $chapter->user->lastName;
            })
            ->addColumn('status',function(Chapter $chapter){
                if($chapter->status == true){
                    return '<div class="badge badge-success">Active</div>';
                }else{
                    return '<div class="badge badge-warning">InActive</div>';
                }
            })
            ->addColumn('free',function(Chapter $chapter){
                if($chapter->free == true){
                    return '<div class="badge badge-success">Free</div>';
                }else{
                    return '<div class="badge badge-danger">Paid</div>';
                }
            })
            ->addColumn('price',function(Chapter $chapter){
                if($chapter->free == false){
                    return $chapter->price;
                }else{
                    return 'N/A';
                }
            })
            ->addColumn('quiz_show',function(Chapter $chapter){
                $quizs = $chapter->quizs;
                $qz = '';
                if($quizs){
                    foreach($quizs as $quiz){
                       $qz = $qz. '<a href="'.route('quiz.show',$quiz->id).'"><div class="badge badge-info mr-1" >'. $quiz->name .'</div></a>';
                    };
                }
                return $qz;
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('chapter.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','user','status','free','quiz_show'])
            ->make(true);


        }


        return view('admin.pages.chapter.chapter');

    }

    public function create()
    {
        $quizs = Quiz::where('status',true)->orderby('order','asc')->get();
        return view('admin.pages.chapter.chapter_add')->with('quizs',$quizs);
    }

    public function store(Request $request)
    {


        $validate = $request->validate([
            'name' => 'required'
        ]);

        $chapter = New Chapter;
        $chapter->user_id = auth()->user()->id;
        $chapter->name = $request->name;
        $chapter->description = $request->description;
        $chapter->content = $request->content;
        $chapter->free = $request->free;
        $chapter->price = $request->price;
        $chapter->status = $request->status;
        $chapter->save();

        if($request->quizs){
            $chapter->quizs()->sync($request->quizs);
        }


        return redirect()->route('chapter.index')
        ->with([
            'message'    =>'Chapter Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show(Chapter $chapter)
    {
        return view('admin.pages.chapter.chapter_show')->with('chapter',$chapter);
    }

    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        $quizs = Quiz::where('status',true)->orderby('order','asc')->get();
        //return response()->json($chapter);

        return view('admin.pages.chapter.chapter_edit')->with('chapter',$chapter)->with('quizs',$quizs);
    }

    public function update(Request $request, Chapter $chapter)
    {
        //return $request->all();
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $chapter->name = $request->name;
        $chapter->description = $request->description;
        $chapter->content = $request->content;
        $chapter->free = $request->free;
        $chapter->price = $request->price;
        $chapter->status = $request->status;
        $chapter->update();

        if($request->quizs){
            $chapter->quizs()->sync($request->quizs);
        }

        return redirect()->route('chapter.index')
        ->with([
            'message'    =>'Chapter Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $chapter = Chapter::destroy($id);

        if($chapter){
            return redirect()->route('chapter.index')
            ->with([
                'message'    =>'Chapter Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
