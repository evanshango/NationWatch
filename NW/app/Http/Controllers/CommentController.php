<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Model\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $comments = Comment::orderBy('id', 'desc')->get();
        return CommentCollection::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return void
     * @throws ValidationException
     */
    public function store(CommentRequest $request)
    {
        $this->validate($request, [
            'description' => 'required|string',
            'image' => 'nullable|max:50128'
        ]);

        $comments = new Comment;
        $comments->description = $request->description;
        $comments->user_id = Auth::user()->id;
        $comments->post_id = $request->post_id;

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $request->file('image')->storeAS('public/comments', $filename);
            $comments->image = 'comments/'.$filename;
        }

        $comments->save();
        return response()->json([
            'message' => 'Comment posted.',
        ]);
    }

    public function show(Request $request){
        $comments = Comment::where('post_id', '=', $request->post_id)->orderBy('id', 'desc')->get();
        return response()->json($comments);
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
            'description' => 'required|string',
            'image' => 'nullable|max:50128'
        ]);

        $comment = Comment::find($id);

        if (Auth::user()->id != $comment->user_id) {
            return response()->json([
                'messaged' => 'Request denied'
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if ($comment == null) {
            return response()->json([
                'messaged' => 'Item not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $comment->description = $request->description;
        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $request->file('image')->storeAS('public/comments', $filename);
            $comment->image = 'comments/'.$filename;
        }

        $comment->update();

        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (Auth::user()->id != $comment->user_id){
            return response()->json([
                'message' => 'Request not permitted'
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if ($comment == null) {
            return response()->json([
                'message' => 'Item not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted'
        ]);
    }
}
