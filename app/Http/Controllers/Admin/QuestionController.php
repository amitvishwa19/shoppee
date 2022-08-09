<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $questions = Question::orderby('order','asc')->latest('id');

            return Datatables::of($questions)
            ->editColumn('created_at',function(Question $question){
                return $question->created_at->diffForHumans();
            })
            ->addColumn('status',function(Question $question){
                if($question->status == true){
                    return '<div class="badge badge-success">Active</div>';
                }else{
                    return '<div class="badge badge-warning">InActive</div>';
                }
            })
            ->addColumn('author',function(Question $question){
                return $question->author->firstName . ',' . $question->author->lastName;
            })
            ->addColumn('type',function(Question $question){
                return Str::ucfirst($question->type);
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('question.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','status','author'])
            ->make(true);


        }


        return view('admin.pages.question.question');

    }

    public function create()
    {
        return view('admin.pages.question.question_add');
    }

    public function store(Request $request)
    {
        //return $request->all();
        $validate = $request->validate([
            'question' => 'required'
        ]);

        $question = New Question;
        $question->user_id = auth()->user()->id;
        $question->question = $request->question;
        $question->score = $request->score;
        $question->type = $request->type;
        $question->status = $request->status;
        $question->save();

        return redirect()->route('question.index')
        ->with([
            'message'    =>'Question Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $question = Question::findOrFail($id);

        return response()->json($question);
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);

        //return response()->json($question);

        return view('admin.pages.question.question_edit',compact('question'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'question' => 'required'
        ]);

        $question = Question::findOrFail($id);
        $question->question = $request->question;
        $question->score = $request->score;
        $question->type = $request->type;
        $question->status = $request->status;
        $question->save();

        return redirect()->route('question.index')
        ->with([
            'message'    =>'Question Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $question = Question::destroy($id);

        if($question){
            return redirect()->route('question.index')
            ->with([
                'message'    =>'Question Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
