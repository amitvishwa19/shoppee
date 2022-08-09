<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Milestone;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {
        //return $tasks = auth()->user()->tasks;

        if ($request->ajax()) {
            $tasks = Task::orderby('created_at','desc')->latest('id');
            $tasks = auth()->user()->tasks()->orderby('created_at','desc');

            return Datatables::of($tasks)
            ->editColumn('created_at',function(Task $task){
                return $task->created_at->diffForHumans();
            })
            
            ->addColumn('progress',function(Task $task){
                return  $task->progress . '%';;
            })
            ->addColumn('duration',function(Task $task){
                return '<p class="text-muted text-right mb-1">'.$task->progress.'% Complete</p>
                        <div class="progress mb-4" style="height: 4px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: '.$task->progress.'%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>';
            })

            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('task.show',$data->id).'" class="badge badge-soft-success mr-2"><small>View</small></a>'.
                            '<a href="'.route('task.edit',$data->id).'" class="badge badge-soft-info mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-soft-danger delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','title','progress','duration'])
            ->make(true);


        };

        $taskCount = Task::count();
        $taskCompleted = Task::where('status','completed')->count();
       

        return view('admin.pages.task.task')->with('taskCount',$taskCount)->with('taskCompleted',$taskCompleted);

    }

    public function create()
    {
        return view('admin.pages.task.task_add');
    }

    public function store(Request $request)
    {

        //dd($request->all());

        $validate = $request->validate([
            'title' => 'required'
        ]);

        $task = New Task;
        $task->user_id = auth()->user()->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;
        $task->progress = 0;
        $task->status = $request->status;
        $task->save();

        $milestones = [];

        if($request->task_item_title){

            for($i=0; $i < count($request->task_item_title); $i++){
                if($request->task_item_title[$i] != null){
                    $taskItem = new Milestone;
                    $taskItem->title = $request->task_item_title[$i];
                    $taskItem->description = $request->task_item_description[$i];
                    $taskItem->status = $request->task_item_status[$i];
                    $taskItem->save();
                    array_push($milestones,$taskItem->id);
                }
            }
        }

        //$task->milestones()->sync($milestones);

        return redirect()->route('task.index')
        ->with([
            'message'    =>'Task Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('admin.pages.task.task_show',compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        //return response()->json($task);

        return view('admin.pages.task.task_edit',compact('task'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validate = $request->validate([
            'title' => 'required'
        ]);

        $task = Task::findOrFail($id);
        $task->user_id = auth()->user()->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;
        $task->progress = 10;
        $task->status = $request->status;
        $task->save();

        $milestones = [];


        if($request->task_item_title){

            for($i=0; $i < count($request->task_item_title); $i++){

                // $taskItem = TaskMilestone::findOrFail($request->task_item_id[$i]);;
                // $taskItem->title = $request->task_item_title[$i];
                // $taskItem->status = $request->task_item_status[$i];
                // $taskItem->save();
                $taskItem = Milestone::updateOrCreate(
                    ['title' => $request->task_item_title[$i]],
                    [
                        'title' => $request->task_item_title[$i],
                        'description' => $request->task_item_description[$i],
                        'status' => $request->task_item_status[$i]
                    ]

                );
                array_push($milestones,$taskItem->id);


            }
        }

        $task->milestones()->sync($milestones);


        //Progress and Status calculation
        $totalItems = $task->milestones()->count();
        $completedItems = $task->milestones()->where('status',true)->count();
        //dd($completedItems);
        if($totalItems > 0 ){
            $progress = ($completedItems / $totalItems) * 100;
            $task->progress = $progress;

            if($progress == 100){
                //dd($progress);
                $task->status = 'completed';
            };
            $task->save();
        }else{
            $task->progress = 0;
            $task->save();
        }
        




        //dd($task->milestones()->where('status',true)->count());

        return redirect()->route('task.index')
        ->with([
            'message'    =>'Task Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $task = Task::destroy($id);
        if($task){
            return redirect()->route('task.index')
            ->with([
                'message'    =>'Task Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
