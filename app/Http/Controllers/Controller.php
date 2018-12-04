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

    protected $perPage = 15;

    protected function extractErrorMessageFromArray($errors)
    {
        $err = [];

        foreach ($errors as $key => $value) {

            $err[]  = is_array($value) ? implode("\n", $value) : $value;
        }
        return implode("\n", $err);
    }

    protected function errorResponse($errors, $code=400) {

        if($errors instanceof MessageBag)
        {
            $errors = $this->extractErrorMessageFromArray($errors->getMessages());

        } else if(is_array($errors))
        {
            $errors = $this->extractErrorMessageFromArray($errors);
        }

        return response()->json([
            'errors' => $errors,
            'data' => null,
            'message' => $errors,
            'status' => 'error'
        ], $code);
    }

    protected function successResponse($message, $data=null, $code=200) {
        return response()->json([
            'errors' => null,
            'data' => $data,
            'message' => $message,
            'status' => 'success'
        ], $code);
    }

    public function getJsonFile(){
        $data =  file_get_contents(public_path('Sample.json'));
        $restaurant = json_decode($data);
        $newArray = [];
        foreach ($restaurant->restaurants as $key => $value) {
            $value->topRestaurants = $this->top_restaurant($value->sortingValues->distance, $value->sortingValues->popularity, $value->sortingValues->ratingAverage);
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

    protected function top_restaurant($distance, $popularity, $rating){
        return floor(($distance * $popularity) + $rating);
    }

    public function sortBy(&$items, $key){
        if (is_array($items)){
            usort($items, function($a, $b) use ($key){
                return $b->sortingValues->$key <=> $a->sortingValues->$key;
            });

            return response()->json($items, 200);
        }
        return false;
    }
}
