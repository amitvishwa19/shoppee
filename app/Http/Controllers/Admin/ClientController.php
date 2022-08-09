<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Detail;
use App\Models\ClientInput;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $clients = Client::orderby('created_at','desc')->latest('id');

            return Datatables::of($clients)
            ->editColumn('created_at',function(Client $client){
                return $client->created_at->diffForHumans();
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('client.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->addColumn('name',function(Client $client){
                // return $user->firstName. ", " .$user->lastName;

                return '<div class="media-body align-self-center">
                            <h6 class="m-0"><b><a href="'.route('client.show',$client->id).'">'. $client->name.'</a></b></h6>
                            <small>'.$client->email.'</small
                        </div>';
            })
            // ->addColumn('projects',function($client){
            //     $projects = $client->projects;
            //     $perm = '';
            //     if($projects){
            //         foreach($projects as $project){
            //             $perm = $perm. '<a href="'.route('project.show',$project->id).'"><div class="badge badge-info mr-1" >'. $project->name .'</div></a>';
            //         };
            //         // .route('project.show',$client->project->id).
            //     }

            //     return $perm;//$permission;
            // })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('client.show',$data->id).'" class="badge badge-soft-success mr-2"><small>View</small></a>'.
                            '<a href="'.route('client.edit',$data->id).'" class="badge badge-soft-info mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-soft-danger delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','name','projects'])
            ->make(true);


        }


        return view('admin.pages.client.client');

    }

    public function create()
    {

        return view('admin.pages.client.client_add');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $client = New Client;
        $client->name = $request->name;
        $client->description = $request->description;
        $client->email = $request->email;
        $client->primary_contact = $request->primary_contact;
        $client->secondary_contact = $request->secondary_contact;
        //if($request->type){$client->type = $request->type;}
        //$client->status = $request->status;
        $client->save();

        $details = [];

        if($request->key != ''){
            for($i=0; $i < count($request->key); $i++){
                if($request->key[$i] != null){
                    $input = new Detail;
                    $input->client_id = $client->id;
                    $input->key = $request->key[$i];
                    $input->value = $request->value[$i];
                    $input->save();
                    array_push($details,$input->id);
                } 
            }
        }

        $client->details()->sync($details);


        return redirect()->route('client.index')
        ->with([
            'message'    =>'Client Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.pages.client.client_view')->with('client',$client);
    }

    public function edit($id)
    {

        $client = Client::findOrFail($id);

        //return response()->json($client);

        return view('admin.pages.client.client_edit',compact('client'));
    }

    public function update(Request $request, Client $client)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $client->name = $request->name;
        $client->description = $request->description;
        $client->email = $request->email;
        $client->primary_contact = $request->primary_contact;
        $client->secondary_contact = $request->secondary_contact;
        $client->update();

        $details = [];

        if($request->key){
            for($i=0; $i < count($request->key); $i++){
                if($request->key[$i] != null){
                    $input = new Detail;
                    $input->client_id = $client->id;
                    $input->key = $request->key[$i];
                    $input->value = $request->value[$i];
                    $input->save();
                    array_push($details,$input->id);
                }
            }
        }

        $client->details()->sync($details);

        return redirect()->route('client.index')
        ->with([
            'message'    =>'Client Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $client = Client::destroy($id);

        if($client){
            return redirect()->route('client.index')
            ->with([
                'message'    =>'Client Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
