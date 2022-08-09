<?php

namespace App\Http\Controllers\Admin;

use Aws\Sdk;
use Aws\Resource\Aws;
use App\Models\Server;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\AWS\AWSService;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServerRequest;

class ServerController extends Controller
{
    public function __construct(){


    }

    public function index()
    {
        $config = config('aws');
        $aws = new Aws($config);
        $bucket = $aws->s3->bucket('devlomatix');
        $object = $bucket->object('profile-7.jpg');
        //return $bucket->respondsTo();
        $buckets =  $aws->s3->buckets;
        //dd($buckets->respondsTo());
        foreach($buckets as $bucket){

        };

        //dd( $aws->s3->buckets);
        return view('admin.pages.server.server')->with('buckets',$buckets);

    }

    public function create()
    {
        return view('admin.pages.server.server_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $server = New Server;
        $server->name = $request->name;
        $server->save();

        return redirect()->route('server.index')
        ->with([
            'message'    =>'Server Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $server = Server::findOrFail($id);

        return response()->json($server);
    }

    public function edit($id)
    {
        $server = Server::findOrFail($id);

        //return response()->json($server);

        return view('admin.pages.server.server_edit',compact('server'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $server = Server::findOrFail($id);
        $server->name = $request->name;
        $server->save();

        return redirect()->route('server.index')
        ->with([
            'message'    =>'Server Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $server = Server::destroy($id);

        if($server){
            return redirect()->route('server.index')
            ->with([
                'message'    =>'Server Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
