<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $msg = '';
        $data = Contact::get();

        if(count($data) == 0){
            $msg = "No Records";
        }
        
        return response()->json(['status' => true, 'data' => $data, 'message' => $msg]);
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
         $data = array(      
                'email' => strip_tags($request->email),
                'first_name' => strip_tags($request->first_name),
                'last_name' => strip_tags($request->last_name),
                'tag' => strip_tags($request->tag),
            );

         $validator = Validator::make($data, [
            'email' => 'required|email|max:255',
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:3|max:15',
            'tag' => 'required'
        ]);

        if ($validator->fails()) {
            
            $yourData =['status' => false, 'data' => null, 'message' => $validator->errors()->first()];

            return response()->json($yourData, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
        }

         Contact::create($data);

        return response()->json(['status' => true, 'data' => null, 'message' => 'created successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Detail = Contact::find($id);
        return response()->json(['status' => true, 'data' => $Detail, 'message' => '']);
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

         $data = array(      
                'email' => strip_tags($request->email),
                'first_name' => strip_tags($request->first_name),
                'last_name' => strip_tags($request->last_name),
                'tag' => strip_tags($request->tag),
            );

         $validator = Validator::make($data, [
            'email' => 'required|email|max:255',
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:3|max:15',
            'tag' => 'required'
        ]);

        if ($validator->fails()) {
            
            $yourData =['status' => false, 'data' => null, 'message' => $validator->errors()->first()];

            return response()->json($yourData, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
        }


         $contact = Contact::find($id);

         $contact->update($data);

        return response()->json(['status' => true, 'data' => null, 'message' => 'Updated successfully']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return response()->json(['status' => true, 'data' => null, 'message' => 'Deleted successfully']);
    }
}
