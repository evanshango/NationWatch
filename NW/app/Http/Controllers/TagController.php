<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tag = Tag::orderBy('id', 'desc')->get();
        return TagCollection::collection($tag);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags'
        ]);
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        return response()->json([
            'message' => 'Success, new tag added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return void
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return void
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:tags'
        ]);

        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->update();

        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag == null) {
            return response()->json([
                'message' => 'Item not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $tag->delete();

        return response()->json([
            'message' => 'Success, Tag deleted'
        ]);
    }
}
