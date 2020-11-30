<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Validator;
use DB;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // info($request);
         // $nearByPlaces = Place::whereRaw("ACOS(SIN(RADIANS('latitude'))*SIN(RADIANS($request->latitude))+COS(RADIANS('latitude'))*COS(RADIANS($request->latitude))*COS(RADIANS('longitude')-RADIANS($request->longitude)))*6380 < 10")->get();
         $nearByPlaces=DB::select(DB::raw("SELECT *,111.045*DEGREES(ACOS(COS(RADIANS(':lat'))*COS(RADIANS(`latitude`))*COS(RADIANS(`longitude`) - RADIANS(':long'))+SIN(RADIANS(':lat'))*SIN(RADIANS(`latitude`)))) AS distance_in_km FROM place ORDER BY distance_in_km asc LIMIT 0,5"), array(
                'lat' => $request->latitude,
                'long' => $request->longitude
              ));
              $response = [];
             $response['status'] = true;
             $response['payload'] = $nearByPlaces;
             return response()->json($response, 200);

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
        //
        // info($request);
        $validator = Validator::make($request->all(), [
            'placeName'  => 'required',
            'latitude'  => 'required',
            'longitude'  => 'required',
            'description'  => 'required',
        ],
        [
            'required'  => ':attribute required',
        ]);

        // check validation
        if ($validator->fails())
        {
            $response = [
                'success' => false,
                'message' => $validator->messages()
            ];

            return response()->json($response, 200);
        }

        $placeName = $request->placeName;
        $latitude   = $request->latitude;
        $longitude  = $request->longitude;
        $description  = $request->description;

        $placeID = Place::insertGetId([
            'placeName' => $placeName,
            'latitude' => $latitude,
            'longitude'   => $longitude,
            'description'    => $description,
            'created_at'  => now(),
            'updated_at'     => now(),

        ]);

        $response = [
            'success' => true,
            'message' => 'Place Added.'
        ];

        return response()->json($response, 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(place $place)
    {
        //
    }
}
