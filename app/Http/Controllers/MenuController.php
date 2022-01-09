<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * hitung jarak
     */
    private function jarak($oriLat, $oriLong, $destLat, $destLong)
    {
        $theta    = $oriLong - $destLong;
        $dist    = sin(deg2rad($oriLat)) * sin(deg2rad($destLat)) +  cos(deg2rad($oriLat)) * cos(deg2rad($destLat)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        
        return round($miles * 1.609344, 2);
    }

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
        //
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

    public function find($id_restaurant)
    {
        $selectedMenu = DB::table('menus')
                ->where('id_restoran', '=', $id_restaurant)
                ->get();
        return $selectedMenu;
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

    /**
     * mencari menu pilihan
     */
    public function observasi(Request $req)
    {
        $origin_latitude = $req->latitude;
        $origin_longitude = $req->longitude;
        $menu = $req->menu;

        //select restaurant that serve the chosen menu
        $selectedRestaurant = DB::table('restaurants')
                                                ->join('menus', 'restaurants.id', '=', 'menus.id_restoran')
                                                ->where('menus.menu_name','like','%' . $menu . '%')
                                                ->where('menus.stok','>', 0)
                                                ->where('restaurants.total_seats','>', 0)
                                                ->select('restaurants.*')
                                                ->orderBy('restaurants.rate', 'desc')
                                                ->orderBy('restaurants.sentiment', 'desc')
                                                ->distinct()
                                                ->get();

        //count the distance
        $i = 0;
        $temp = json_decode($selectedRestaurant, true);
        while ($i < sizeof($temp)){
            $restaurant_latitude = $temp[$i]["latitude"];
            $restaurant_longitude = $temp[$i]["longitude"];
            $jarak = $this->jarak($origin_latitude, $origin_longitude, $restaurant_latitude, $restaurant_longitude);
            $temp[$i]["jarak"] = $jarak;
            $i = $i+1;
        }
        

        return json_encode($temp, JSON_PRETTY_PRINT);
    }
}
