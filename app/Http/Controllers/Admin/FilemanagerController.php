<?php

namespace App\Http\Controllers\Admin;

use App\Models\Filemanager;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FilemanagerRequest;

class FilemanagerController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {
        //dd($request->get('type'));
        $files = Filemanager::where('type','file')->where('parent_id',$request->id)->get();
        $folders = Filemanager::where('type','folder')->where('parent_id',$request->id)->get();
        
        //dd($files);

        if($request->get('type') == 'all'){
            return view('admin.pages.filemanager.filemanager')->with('files',$files)->with('folders',$folders);


        }elseif($request->get('type') == 'folder'){


            return view('admin.pages.filemanager.filemanager')->with('files',$files)->with('folders',$folders);
        }
        //return view('admin.pages.filemanager.filemanager')->with('files',$files)->with('folders',$folders);

    }

    public function create()
    {
        return view('admin.pages.filemanager.filemanager_add');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        
      

        if($request->folder != null){
            $folder = new Filemanager;
            $folder->user_id = auth()->user()->id;
            $folder->parent_id = $request->id;
            $folder->name = $request->folder;
            $folder->slug = Str::slug($request->folder,'-');
            $folder->type = 'folder';
            $folder->status = true;
            $folder->save();


            return redirect()->route('filemanager.index',['type'=>$request->type,'id'=>$request->id])->with(['message'    =>'Folder Added Successfully','alert-type' => 'success',]);
        }else{
            return redirect()->route('filemanager.index')->with(['message'    =>'Provide  name of folder to be added','alert-type' => 'error',]);
        }



        $filemanager = New Filemanager;
        $filemanager->name = $request->name;
        $filemanager->save();

        return redirect()->route('filemanager.index')->with(['message'    =>'Filemanager Added Successfully','alert-type' => 'success',]);

    }

    public function show($id)
    {
        $filemanager = Filemanager::findOrFail($id);

        return response()->json($filemanager);
    }

    public function edit($id)
    {
        $filemanager = Filemanager::findOrFail($id);

        //return response()->json($filemanager);

        return view('admin.pages.filemanager.filemanager_edit',compact('filemanager'));
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required'
        ]);

        $filemanager = Filemanager::findOrFail($id);
        $filemanager->name = $request->name;
        $filemanager->save();

        return redirect()->route('filemanager.index')
        ->with([
            'message'    =>'Filemanager Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $filemanager = Filemanager::destroy($id);

        if($filemanager){
            return redirect()->route('filemanager.index')
            ->with([
                'message'    =>'Filemanager Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }
}
