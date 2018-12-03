<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getJsonFile(){
        $data =  file_get_contents(public_path('Sample.json'));
        $restaurant = json_decode($data);
//        return response()->json($restaurant->restaurants, 200);
        $newArray = [];
        foreach ($restaurant->restaurants as $key => $value) {
            # code...
            $value->topRestaurants = floor(($value->sortingValues->distance * $value->sortingValues->popularity) + $value->sortingValues->ratingAverage);
            $newArray[] = $value;
        }

        usort($newArray, function($a, $b) {
            $retVal = $b->favourite <=> $a->favourite;
            return $retVal;
        });

        $final_array = [];
        foreach ($newArray as $key => $value) {
            # code...
            if($value->status == 'open' && $value->favourite == 'yes')$final_array[] = $value;
            if($value->status == 'open' && $value->favourite == 'no')$final_array[] = $value;
            if ($value->status == 'order ahead' && $value->favourite == 'yes' && !(in_array($value->name, $final_array)))$final_array[] = $value;
            if ($value->status == 'closed' && $value->favourite == 'yes' && !(in_array($value->name, $final_array)))$final_array[] = $value;
        }


        $closed = [];
        foreach ($newArray as $key => $value) {
            # code...
            if($value->status == 'closed' && $value->favourite !== 'yes')$closed[] = $value;
        }

        $order_ahead = [];
        foreach ($newArray as $key => $value) {
            # code...
            if($value->status == 'order ahead' && $value->favourite !== 'yes')$order_ahead[] = $value;
        }

        $result = array_merge($final_array, $order_ahead);
        $result1 = array_merge($result, $closed);

        return response()->json($result1, 200);
    }
}
