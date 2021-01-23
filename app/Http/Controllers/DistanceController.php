<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public $officeDublin;

    //setter
    public function setOfficeDublin(array $officeDublin){
        $this->officeDublin = $officeDublin;
    }

    //getter
    public function getOfficeDublin(){
        return $this->officeDublin;
    }

    public function calculate(Request $request)
    {
        $arrDistances = $request->data;
        $coordOffice = array('latitude' => 53.3340285, 'longitude' => -6.2535495);
        $this->setOfficeDublin($coordOffice);
        $cont = 0;
        
        foreach ($arrDistances as $key => $value){
            
            // convert from degrees to radians
            $latFrom = deg2rad($value['latitude']);
            $lonFrom = deg2rad($value['longitude']);
            $latTo = deg2rad($this->getOfficeDublin()['latitude']);
            $lonTo = deg2rad($this->getOfficeDublin()['longitude']);

            //creating delta
            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            //haversine formula (https://en.wikipedia.org/wiki/Great-circle_distance)
            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            
            //distance final earthRadius in Km and distance with only 2 number after .
            $earthRadius = 6371;
            $distance = (float) number_format($angle * $earthRadius, 2);
            
            //populating return array only if the distance between the 2 points are lower than 100Km
            
            if($distance < 100){
                $arrReturn[$cont] =  array(
                    'id' => $value['affiliate_id'],
                    'name' => $value['name'],
                    'distance' => $distance
                );
                $cont++;
            }
           
        }
        //returning values
        return (json_encode($arrReturn));
    }
}
