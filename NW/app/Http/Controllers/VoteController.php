<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Model\Downvote;
use App\Model\Upvote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function upvote(){
        $upvote = Upvote::all();
        return response()->json($upvote);
    }

    public function doUpvote(VoteRequest $request)
    {
        $upvote = Upvote::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('post_id', '=', $request->post_id)
            ->first();
        $downvote = Downvote::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('post_id', '=', $request->post_id)
            ->first();
        if ($upvote == null && $downvote == null){
            $upvote = new Upvote;
            $upvote->post_id = $request->post_id;
            $upvote->user_id = Auth::user()->id;
            $upvote->save();
        } elseif ($upvote == null && $downvote != null){
            $downvote->delete();
            $upvote = new Upvote;
            $upvote->post_id = $request->post_id;
            $upvote->user_id = Auth::user()->id;
            $upvote->save();
        } else{
            $upvote->delete();
            return response()->json([
                'message' => '-1'
            ]);
        }

        return response()->json([
            'message' => '+1'
        ]);
    }

    public function downvote(){
        $downvote = Downvote::all();
        return response()->json($downvote);
    }

    public function doDownvote(VoteRequest $request){
        $downvote = Downvote::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('post_id', '=', $request->post_id)
            ->first();
        $upvote = Upvote::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('post_id', '=', $request->post_id)
            ->first();
        if ($downvote == null && $upvote == null){
            $downvote = new Downvote;
            $downvote->post_id = $request->post_id;
            $downvote->user_id = Auth::user()->id;
            $downvote->save();
        } elseif ($downvote == null && $upvote != null){
            $upvote->delete();
            $downvote = new Downvote;
            $downvote->post_id = $request->post_id;
            $downvote->user_id = Auth::user()->id;
            $downvote->save();
        } else{
            $downvote->delete();
            return response()->json([
                'message' => '-1'
            ]);
        }

        return response()->json([
            'message' => '+1'
        ]);
    }
}
