<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyPlusRequest;
use App\Model\ReplyPlus;
use Illuminate\Support\Facades\Auth;

class ReplyPlusController extends Controller
{
    public function index()
    {
        $replyplus = ReplyPlus::all();
        return response()->json($replyplus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReplyPlusRequest $request
     * @return void
     */
    public function store(ReplyPlusRequest $request)
    {
        $replyplus = ReplyPlus::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('reply_id', '=', $request->reply_id)
            ->first();
        if ($replyplus == null){
            $replyplus = new ReplyPlus;
            $replyplus->reply_id = $request->reply_id;
            $replyplus->user_id = Auth::user()->id;
            $replyplus->save();
        } else{
            $replyplus->delete();
            return response()->json([
                'message' => '-1'
            ]);
        }

        return response()->json([
            'message' => '+1'
        ]);
    }

}
