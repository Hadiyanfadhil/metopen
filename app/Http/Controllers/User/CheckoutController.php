<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Township;
use Illuminate\Http\Request;
use App\Models\StateDivision;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //checkout page
    public function checkoutPage(){
        $stateDivisions = StateDivision::get();
        return view('frontEnd.checkout')->with(['stateDivisions'=>$stateDivisions]);
    }

    //get city ajax
    public function getCity(Request $request){
        $cities = City::where('state_division_id',$request->id)->get();
        return response()->json([
            'cities' => $cities,
        ]);
    }

    //get township ajax
    public function getTownship(Request $request){
        $townships = Township::where('city_id',$request->id)->get();
        return response()->json([
            'townships' => $townships,
        ]);
    }

    


}
