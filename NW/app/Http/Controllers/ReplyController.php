<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Http\Resources\Reply\ReplyCollection;
use App\Model\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $replies = Reply::orderBy('id', 'desc')->get();
        return ReplyCollection::collection($replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReplyRequest $request
     * @return void
     */
    public function store(ReplyRequest $request)
    {
        $reply = new Reply;
        $reply->reply = $request->reply;
        $reply->comment_id = $request->comment_id;
        $reply->user_id = Auth::user()->id;

        $reply->save();
        return response()->json([
            'message' => 'Reply saved.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $request){
        $reply = Reply::where('comment_id', '=', $request->comment_id)->orderBy('id', 'desc')->get();
        return response()->json($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReplyRequest $request
     * @param $id
     * @return void
     */
    public function update(ReplyRequest $request, $id)
    {
        $reply = Reply::find($id);
        if (Auth::user()->id != $reply->user_id) {
            return response()->json([
                'messaged' => 'Request denied'
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if ($reply == null) {
            return response()->json([
                'messaged' => 'Item not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $reply->reply = $request->reply;
        $reply->comment_id = $request->comment_id;
        $reply->user_id = Auth::user()->id;
        $reply->update();

        return response()->json($reply);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $reply = Reply::find($id);
        if ($reply == null) {
            return response()->json([
                'message' => 'Item not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $reply->delete();

        return response()->json([
            'message' => 'Reply deleted'
        ]);
    }
}
