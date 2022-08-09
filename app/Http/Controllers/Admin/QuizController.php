<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\QuizRequest;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $quizzes = Quiz::orderby('order','asc')->latest('id');

            return Datatables::of($quizzes)
            ->editColumn('created_at',function(Quiz $quiz){
                return $quiz->created_at->diffForHumans();
            })
            ->addColumn('notice_published',function(Quiz $quiz){
                if($quiz->notice_published == true){
                    return '<div class="badge badge-success">Published</div>';
                }else{
                    return '<div class="badge badge-warning">Pending</div>';
                }
            })
            ->addColumn('result_published',function(Quiz $quiz){
                if($quiz->result_published == true){
                    return '<div class="badge badge-success">Published</div>';
                }else{
                    return '<div class="badge badge-warning">Pending</div>';
                }
            })
            ->addColumn('questions',function(Quiz $quiz){
                return $quiz->questions->count();
            })
            ->addColumn('status',function(Quiz $quiz){
                if($quiz->status == true){
                    return '<div class="badge badge-success">Active</div>';
                }else{
                    return '<div class="badge badge-warning">InActive</div>';
                }
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('quiz.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','status','result_published','notice_published'])
            ->make(true);


        }


        return view('admin.pages.quiz.quiz');

    }

    public function create()
    {
        $questions = Question::where('status',true)->orderby('order','asc')->get();
        return view('admin.pages.quiz.quiz_add')->with('questions',$questions);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $quiz = New Quiz;
        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->start_date = $request->start_date;
        $quiz->end_date = $request->end_date;
        $quiz->status = $request->status;
        $quiz->save();

        if($request->questions){
            $quiz->questions()->sync($request->questions);
        }

        return redirect()->route('quiz.index')
        ->with([
            'message'    =>'Quiz Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show(Quiz $quiz)
    {
        return view('admin.pages.quiz.quiz_show')->with('quiz',$quiz);
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = Question::where('status',true)->orderby('order','asc')->get();
        //return response()->json($quiz);

        return view('admin.pages.quiz.quiz_edit')->with('quiz',$quiz)->with('questions',$questions);
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->start_date = $request->start_date;
        $quiz->end_date = $request->end_date;
        $quiz->status = $request->status;
        $quiz->save();

        if($request->questions){
            $quiz->questions()->sync($request->questions);
        }

        return redirect()->route('quiz.index')
        ->with([
            'message'    =>'Quiz Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $quiz = Quiz::destroy($id);

        if($quiz){
            return redirect()->route('quiz.index')
            ->with([
                'message'    =>'Quiz Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
