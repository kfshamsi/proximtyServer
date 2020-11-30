<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;
use Validator;
use DB;

class ReviewController extends Controller
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
        $validator = Validator::make($request->all(), [
            'placeID'  => 'required',
            'userID'  => 'required',
            'rating'  => 'required',
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

        $placeID = $request->placeID;
        $userID   = $request->userID;
        $rating  = $request->rating;
        $description  = $request->description;

        $placeID = Review::insertGetId([
            'placeID' => $placeID,
            'userID' => $userID,
            'rating'   => $rating,
            'description'    => $description,
            'created_at'  => now()

        ]);

        $response = [
            'success' => true,
            'message' => 'Review Added.'
        ];

        return response()->json($response, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(review $review)
    {
        //
    }
}
