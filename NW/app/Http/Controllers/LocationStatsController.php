<?php

namespace App\Http\Controllers;

use App\Http\Resources\Location\LocationCollection;
use App\Model\Location;
use App\Model\LocationStats;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $location_stats = LocationStats::all();
        return response()->json($location_stats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return AnonymousResourceCollection
     */
    public function store()
    {
        $location = Location::where('name', '=', 'Mombasa')->get();
        return LocationCollection::collection($location);
    }

    /**
     * Display the specified resource.
     *
     * @param LocationStats $locationStats
     * @return void
     */
    public function show(LocationStats $locationStats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LocationStats $locationStats
     * @return void
     */
    public function edit(LocationStats $locationStats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param LocationStats $locationStats
     * @return void
     */
    public function update(Request $request, LocationStats $locationStats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LocationStats $locationStats
     * @return void
     */
    public function destroy(LocationStats $locationStats)
    {
        //
    }
}
