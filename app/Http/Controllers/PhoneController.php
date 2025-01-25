<?php

namespace App\Http\Controllers;

use App\Models\phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $phones = Phone::All();
        // $customers ;
        // $i = 0;
        // foreach($phones as $phone){
        //    $customers[$i] = $phone->customer;
        //    $i++ ;
        // }
        // return $customers;
        $phone = phone::find(2);
        return $phone->customer->name;
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
        $newPhone = new Phone;
        try {
            $newPhone->tel = $request->tel;
            $newPhone->customer_id = $request->customer_id;
            $newPhone->save();
        } catch (\Throwable $th) {
            return [
                'Success' => false,
                'Message' => 'saving error: '.$th,
            ];
        }
        return [
            'Success' => true,
            'Message' => 'phone added successfully' 
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(phone $phone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(phone $phone)
    {
        //
    }

    public static function test()
    {
        return ['well nicewww'];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, phone $phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(phone $phone)
    {
        //
    }
}
