<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use Validator;


class RestaurantController extends Controller
{
    public function getAllRestaurant(){
        //Fetch all the restaurants from the json file
        $restaurants = $this->getJsonFile()->getData();
        return view('welcome', compact('restaurants'));
    }

    public function sorting(Request $request){
        $validate = Validator::make($request->all(), [
            'sorting' => 'required|string'
        ]);

        if($validate->fails())
        {
            return $this->errorResponse($validate->errors());
        }

        try{

        }
        catch (\Exception $exception){
            return $this->errorResponse('failed');
        }
    }

    public function sorting_value(Request $request){
        $data = $this->getJsonFile();
        $array_data = $data->getData();
        $array_value = $this->sortBy($array_data, $request->input('sort'));
        return $this->successResponse('success', $array_value);
    }
}
