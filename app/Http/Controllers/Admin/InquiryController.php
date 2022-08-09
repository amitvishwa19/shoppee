<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InquiryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $inquiries = Inquiry::orderby('created_at','desc')->latest('id');

            return Datatables::of($inquiries)
            ->editColumn('created_at',function(Inquiry $inquiry){
                return $inquiry->created_at->diffForHumans();
            })
            ->addColumn('inquiry',function(Inquiry $inquiry){
                return '<div class="card">
                            <div class="card-body">
                                <div class="media mb-3">
                                    <div class="media-body align-self-center text-truncate">
                                        <h4 class="m-0 font-weight-semibold text-dark font-15">'.$inquiry->subject.'</h4>
                                        <p class="text-muted  mb-0 font-13"><span class="text-dark">By : </span>'.$inquiry->name.'</p>
                                        <p class="text-muted  mb-0 font-13"><span class="text-dark"></span>'.$inquiry->email.'('.$inquiry->phone.')</p>
                                    </div><!--end media-body-->
                                </div>
                                <hr class="hr-dashed">
                                <div>
                                    <p class="text-muted mt-2 mb-1">'.$inquiry->message.'</p>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="font-weight-semibold">
                                           <span class="badge badge-soft-pink font-weight-semibold ml-2"><i class="far fa-fw fa-clock"></i>'.$inquiry->created_at->diffForHumans().'</span>
                                        </h6>
                                    </div>


                                    <div class="d-flex justify-content-between">
                                        <div class="img-group">

                                        </div>
                                        <ul class="list-inline mb-0 align-self-center">
                                            <li class="list-item d-inline-block">
                                                <a class="ml-2" href="'.route('inquiry.show',$inquiry->id).'" >
                                                    <i class="mdi mdi-file-send text-muted font-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-item d-inline-block">
                                                <a class="delete" href="javascript:void(0);" id="'.$inquiry->id.'">
                                                    <i class="mdi mdi-trash-can-outline text-muted font-18"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!--end task-box-->
                                </div><!--end card-body-->
                            </div>';

            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('inquiry.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','inquiry'])
            ->make(true);


        }


        return view('admin.pages.inquiry.inquiry');

    }

    public function create()
    {
        return view('admin.pages.inquiry.inquiry_add');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $validate = $request->validate([
        //     'response' => 'required'
        // ]);

        // $inquiry = New Inquiry;
        // $inquiry->name = $request->name;
        // $inquiry->save();

        // return redirect()->route('inquiry.index')
        // ->with([
        //     'message'    =>'Inquiry Added Successfully',
        //     'alert-type' => 'success',
        // ]);

    }

    public function show($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        return view('admin.pages.inquiry.inquiry_show')->with('inquiry',$inquiry);
    }

    public function edit($id)
    {
        $inquiry = Inquiry::findOrFail($id);

        //return response()->json($inquiry);

        return view('admin.pages.inquiry.inquiry_edit',compact('inquiry'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validate = $request->validate([
            'response' => 'required'
        ]);

        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = 'close';
        $inquiry->user_id = auth()->user()->id;
        $inquiry->response = $request->response;
        $saved = $inquiry->save();

        if($saved){
            //dd($inquiry->subject);
            $to = $request->email;
            $subject = 'RE:' . $inquiry->subject;
            $body = 'test body';
            $data = array(
                        'name' => $inquiry->name,
                        'response' => $inquiry->response,
                        'message' => $inquiry->message
                    );
            $view = 'mails.inquiryresponse';

            appmail($to,$subject,$body,$data,$view,true);

        }


        return redirect()->route('inquiry.index')
        ->with([
            'message'    =>'Response sent successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $inquiry = Inquiry::destroy($id);

        if($inquiry){
            return redirect()->route('inquiry.index')
            ->with([
                'message'    =>'Inquiry Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
