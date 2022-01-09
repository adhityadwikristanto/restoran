<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        // $arrayreq = array(
        //     array(
        //         "tanggal" =>  "2021-01-10",
        //         "email" => "user@email.id",
        //         "seat"=> 3,
        //         "id_menu" => 7,
        //         "kuantitas" => 1
        //     ),
        //     array(
        //         "tanggal" =>  "2021-01-10",
        //         "email" => "user@email.id",
        //         "seat"=> 3,
        //         "id_menu" => 8,
        //         "kuantitas" => 2
        //     )
        // );
        // $jsonreq = json_encode($arrayreq,JSON_FORCE_OBJECT);
        


        $req = json_decode($request, true);

        
        // // $req = $toArray[0];
        // $tanggal = $req['tanggal'];
        // $email = $req['email'];
        // $seat = $req['seat'];
        // // $data[] = $req['data'];
        // $tanggal = $req['tanggal'];
        // $tanggal = $req['id_menu'];
        // $tanggal = $req['kuantitas'];
        // $tanggal = $req->tanggal;
        // $email = $req->email;
        // $seat = $req->seat;
        // $data = $req->data;

        $forreturn = [];
        $i=0;
        while($i < sizeof($req)){
            $order = new Order();
            $order->tanggal = $req[$i]["tanggal"];
            $order->email = $req[$i]["email"];
            $order->seat = $req[$i]["seat"];
            $order->id_menu = $req[$i]["id_menu"];
            $order->kuantitas = $req[$i]["kuantitas"];
            $order->save();
            array_push($forreturn, $order);
            $i += 1;
        }
        
        return $forreturn;
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
        //
    }
}
