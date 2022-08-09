<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChatRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Chat;

class ChatController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $chats = Chat::orderby('created_at','desc')->latest('id');

            return Datatables::of($chats)
            ->editColumn('created_at',function(Chat $chat){
                return $chat->created_at->diffForHumans();
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('chat.edit',$data->id).'" class="mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);


        }


        return view('admin.pages.chat.chat');

    }

    public function create()
    {
        return view('admin.pages.chat.chat_add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $chat = New Chat;
        $chat->name = $request->name;
        $chat->save();

        return redirect()->route('chat.index')
        ->with([
            'message'    =>'Chat Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $chat = Chat::findOrFail($id);

        return response()->json($chat);
    }

    public function edit($id)
    {
        $chat = Chat::findOrFail($id);

        //return response()->json($chat);

        return view('admin.pages.chat.chat_edit',compact('chat'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $chat = Chat::findOrFail($id);
        $chat->name = $request->name;
        $chat->save();

        return redirect()->route('chat.index')
        ->with([
            'message'    =>'Chat Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $chat = Chat::destroy($id);

        if($chat){
            return redirect()->route('chat.index')
            ->with([
                'message'    =>'Chat Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
