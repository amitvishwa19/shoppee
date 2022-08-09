<?php

namespace App\Http\Controllers\Api\v2\grocery;

use App\Models\Cart;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CartCollection;
use App\Http\Resources\AddressResource;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       $user = auth()->user();
       $addresses = $user->addresses;
       return AddressResource::collection($addresses);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
       
        $user = auth()->user();
        $address = New Address(); 
        $address->user_id = $user->id;
        $address->house = $request->house;
        $address->locality = $request->locality;
        $address->landmark = $request->landmark;
        $address->optional = $request->optional;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->pincode = $request->pincode;
        $address->mobile = $request->mobile;
        $address->type = $request->type;
       
        $address->save();

        if($address){
            return response()->json(['message' => 'success'],200);
        }else{
            return response()->json(['message' => 'Error'],500);
        }

      
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
    public function update($id,Request $request)
    {
        
        $user = auth()->user();
        $address = Address::find($id); 
        $address->user_id = $user->id;
        $address->house = $request->house;
        $address->locality = $request->locality;
        $address->landmark = $request->landmark;
        $address->optional = $request->optional;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->pincode = $request->pincode;
        $address->mobile = $request->mobile;
        $address->type = $request->type;
        $address->save();

        return new AddressResource($address);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        

        $address = Address::destroy($request->id);

        if($address){
            return response()->json(['message' => 'Deleted successfully'],200);
        }else{
            return response()->json(['message' => 'Error'],500);
        }

    }
}
