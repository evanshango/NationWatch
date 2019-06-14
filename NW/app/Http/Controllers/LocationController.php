<?php

namespace App\Http\Controllers;

use App\Http\Resources\Location\LocationCollection;
use App\Model\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::orderBy('code', 'asc')->get();
//        return LocationCollection::collection($location);
        return response()->json($location);
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

    public function show(Request $request)
    {
        $code = $request->id;
            $location = Location::where('id', '=', $code)->get();
            $result = LocationCollection::collection($location);
            if ($result->isEmpty()) {
                return response()->json([
                    'message' => 'There are no posts for this location'
                ]);
            } else {
                return $result;
            }

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
