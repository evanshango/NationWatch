<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Model\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as RequestAlias;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $post = Post::orderBy('id', 'desc')->get();
        return PostCollection::collection($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return void
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->text = $request->text;
        $post->media_type = $request->media_type;
        $post->tag1_id = $request->tag1_id;
        $post->tag2_id = $request->tag2_id;
        $post->tag3_id = $request->tag3_id;
        $post->is_positive = $request->is_positive;
        $post->user_id = Auth::user()->id;

        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $filename = time() . '.' . $media->getClientOriginalExtension();
            $path = $request->file('media')->storeAS('public/posts', $filename);
            $post->media = 'posts/'.$filename;
        }
        $post->save();
        return response()->json([
            'message' => 'Posts added successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     * @param RequestAlias $request
     * @return AnonymousResourceCollection
     */
    public function show(RequestAlias $request)
    {
        $post = Post::where('id', '=', $request->id)->orderBy('id', 'desc')->get();
        if ($post == null){
            return response()->json([
                'message' => 'Item not be found'
            ], Response::HTTP_NOT_FOUND);
        }
        return PostCollection::collection($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param $id
     * @return Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            return response()->json([
                'message' => 'Request not permitted'
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if ($post == null) {
            return response()->json([
                'message' => 'Item not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $post->text = $request->text;
        $post->media_type = $request->media_type;
        $post->tag1_id = $request->tag1_id;
        $post->tag2_id = $request->tag2_id;
        $post->tag3_id = $request->tag3_id;
        $post->is_positive = $request->is_positive;
        $post->user_id = Auth::user()->id;

        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $filename = time() . '.' . $media->getClientOriginalExtension();
            $path = $request->file('media')->storeAS('public/posts', $filename);
            $post->media = $filename;
        }
        $post->update();
        return response()->json([
            'message' => 'Posts added successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id){
            return response()->json([
                'message' => 'Request not permitted'
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if ($post == null) {
            return response()->json([
                'message' => 'Item not be found'
            ], Response::HTTP_NOT_FOUND);
        }
        $post->delete();
        return response()->json([
            'message' => 'Post deleted'
        ]);
    }
}
