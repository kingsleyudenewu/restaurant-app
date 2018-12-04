<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;


class RestaurantController extends Controller
{
    public function getAllRestaurant(){
        //Fetch all the restaurants from the json file
        $restaurants = $this->getJsonFile()->getData();
        return view('welcome', compact('restaurants'));
    }

    public function getSorting(Request $request, $sort){
        $validate = Validator::make($request->all(), [
            'sorting' => 'required|string'
        ]);

        if($validate->fails())
        {
            return $this->errorResponse($validate->errors());
        }

        try{
            $data = $this->getJsonFile();
            $array_data = $data->getData();
            $array_value = $this->sortBy($array_data, $request->input('sort'));
            return $this->successResponse('success', $array_value);
        }
        catch (\Exception $exception){
            return $this->errorResponse('failed');
        }
    }
}
