<?php

namespace App\Http\Controllers;

use App\Model\ReportComment;
use App\Model\ReportPost;
use App\Model\ReportReply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function reportPosts()
    {
        $postreports = ReportPost::all();
        return response()->json($postreports);
    }

    public function reportComments(){
        $commentreports = ReportComment::all();
        return response()->json($commentreports);
    }

    public function reportReplies(){
        $replyreports = ReportReply::all();
        return response()->json($replyreports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function reportPost(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id|numeric'
        ]);

        $reportpost = ReportPost::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('post_id', '=', $request->post_id)
            ->first();
        if ($reportpost == null) {
            $reportpost = new ReportPost;
            $reportpost->post_id = $request->post_id;
            $reportpost->user_id = Auth::user()->id;
            $reportpost->save();
        } else {
            return response()->json([
                'message' => 'You already reported this post'
            ]);
        }

        return response()->json([
            'message' => 'You reported this post',
        ], Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function reportComment(Request $request)
    {
        $this->validate($request, [
            'comment_id' => 'required|exists:comments,id|numeric'
        ]);

        $reportcomment = ReportComment::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('comment_id', '=', $request->comment_id)
            ->first();
        if ($reportcomment == null) {
            $reportcomment = new ReportComment;
            $reportcomment->comment_id = $request->comment_id;
            $reportcomment->user_id = Auth::user()->id;
            $reportcomment->save();
        } else {
            return response()->json([
                'message' => 'You already reported this comment'
            ]);
        }

        return response()->json([
            'message' => 'You reported this comment',
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function reportReply(Request $request)
    {
        $this->validate($request, [
            'reply_id' => 'required|exists:replies,id|numeric'
        ]);

        $reportreply = ReportReply::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('reply_id', '=', $request->reply_id)
            ->first();
        if ($reportreply == null) {
            $reportreply = new ReportReply;
            $reportreply->reply_id = $request->reply_id;
            $reportreply->user_id = Auth::user()->id;
            $reportreply->save();
        } else {
            return response()->json([
                'message' => 'You already reported this reply'
            ]);
        }

        return response()->json([
            'message' => 'You reported this reply',
        ], Response::HTTP_OK);
    }

}
