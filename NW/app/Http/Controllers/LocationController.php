<?php

namespace App\Http\Controllers;

use App\Http\Resources\Location\LocationCollection;
use App\Model\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::all();
        return LocationCollection::collection($location);
    }
    public function store(Request $request)
    {
        $locations = new Location();
        $locations->code = $request->code;
        $locations->name = $request->name;
        $locations->latitude = $request->latitude;
        $locations->longitude = $request->longitude;

        $locations->save();
        return response()->json([
            'message' => 'Success, location added'
        ]);
    }

    public function show(Location $location)
    {
        //
    }

    public function update(Request $request, Location $location)
    {
        //
    }
    public function destroy(Location $location)
    {
        //
    }
}
