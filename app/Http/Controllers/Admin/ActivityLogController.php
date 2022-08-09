<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //abort(403);
        // $act = activity()
        //         ->causedBy(auth()->user())
        //         ->log('Look mum, I logged something');

        //$activities = Activity::latest('id');

        //dd($activities);

        if ($request->ajax()) {
            $activities = Activity::latest('id');

            return Datatables::of($activities)

            ->editColumn('created_at',function(Activity $activity){
                return $activity->created_at->diffForHumans();
            })
            ->addColumn('checkbox', '<input type="checkbox" name="id" class="checkbox" value="{{$id}}"/>')
            ->addColumn('action',function($data){
                        $link = '<div class="d-flex">'.
                                    '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-soft-danger delete"><small>Delete</small></a>'.
                                '</div>';
                        return $link;
                    })
            ->rawColumns(['action','checkbox'])
            ->make(true);

        }

        //return view('admin.pages.log.activity');
        return view('admin.pages.logs.activity');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(",", $id);



        $activity = Activity::destroy($ids);

        if($activity){
            return redirect()->route('activity.index')
            ->with([
                'message'    =>'Activity deleted Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }
    }
}
