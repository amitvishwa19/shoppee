<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Events\SubscriptionEvent;
use App\Services\AppMailingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $subscriptions = Subscription::orderby('created_at','desc')->latest('id');

            return Datatables::of($subscriptions)
            ->editColumn('created_at',function(Subscription $subscription){
                return $subscription->created_at->diffForHumans();
            })
            ->addColumn('status',function(Subscription $subscription){
                if($subscription->status == true){
                    return '<a href="'.route('subscription.edit',$subscription->id).'" class="badge badge-soft-success"><small>Active</small></a>';
                }else{
                    return '<a href="'.route('subscription.edit',$subscription->id).'" class="badge badge-soft-dark"><small>InActive</small></a>';
                }
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('subscription.edit',$data->id).'" class="badge badge-soft-primary mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-soft-danger delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','status'])
            ->make(true);


        }


        return view('admin.pages.subscription.subscription');

    }

    public function create()
    {
        return view('admin.pages.subscription.subscription_add');
    }

    public function store(Request $request,AppMailingService $mail)
    {
        $validate = $request->validate([
            'email' => 'required'
        ]);

        $subscription = New Subscription;
        $subscription->email = $request->email;
        $subscription->save();

        //Sending confirmation mail
        // $to = $request->email;
        // $from = 'info@devlomatix.com';
        // $subject = 'Devlomatix Solutions Newsletter and Updates subscription';
        // $body = 'This is the mail body of test mail';
        // $data =["title" => "hello", "description" => "test test test"];
        // $view = 'mails.subscription';

        // $mail->sendMailJob($to,$subject,$body,$data,$view);

        event(new SubscriptionEvent($request->email));

        return redirect()->route('subscription.index')
        ->with([
            'message'    =>'Subscription Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);

        return response()->json($subscription);
    }

    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);

        //return response()->json($subscription);

        return view('admin.pages.subscription.subscription_edit',compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        //return $request->all();
        $validate = $request->validate([
            'email' => 'required'
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->email = $request->email;
        if($request->status){
            $subscription->status = 1;
        }else{
            $subscription->status = 0;
        }
        $subscription->save();

        return redirect()->route('subscription.index')
        ->with([
            'message'    =>'Subscription Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $subscription = Subscription::destroy($id);

        if($subscription){
            return redirect()->route('subscription.index')
            ->with([
                'message'    =>'Subscription Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
