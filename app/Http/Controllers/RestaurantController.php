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
        $sorting_value = $this->sortBy($restaurants, 'bestMatch')->getData();
        return view('welcome', compact('sorting_value'));
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
            $data = $this->getJsonFile();
            $array_data = $data->getData();
            $array_value = $this->sortBy($array_data, $request->input('sorting'));
            return $this->successResponse('success', $array_value->getData());
        }
        catch (\Exception $exception){
            return $this->errorResponse('failed');
        }
    }

    public function fav_sorting(Request $request){
        $validate = Validator::make($request->all(), [
            'fav_sorting' => 'required|string'
        ]);

        if($validate->fails())
        {
            return $this->errorResponse($validate->errors());
        }

        try{
            $data = $this->getJsonFile();
            $array_data = $data->getData();

            if($request->input('fav_sorting') == 'fav'){
                $array_value = $this->sortByFavourite($array_data);
                return $this->successResponse('success', $array_value->getData());
            }
            elseif ($request->input('fav_sorting') == 'non_fav'){
                $array_value = $this->sortByNonFavourite($array_data);
                return $this->successResponse('success', $array_value->getData());
            }

            return $this->errorResponse('Failed');

        }
        catch (\Exception $exception){
            return $this->errorResponse('failed');
        }
    }
}
