<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentPlusRequest;
use App\Model\CommentPlus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentPlusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $commentplus = CommentPlus::all();
        return response()->json($commentplus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentPlusRequest $request
     * @return Response
     */
    public function store(CommentPlusRequest $request)
    {
        $commentplus = CommentPlus::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('comment_id', '=', $request->comment_id)
            ->first();
        if ($commentplus == null){
            $commentplus = new CommentPlus;
            $commentplus->comment_id = $request->comment_id;
            $commentplus->user_id = Auth::user()->id;
            $commentplus->save();
        } else{
            $commentplus->delete();
            return response()->json([
                'message' => '-1'
            ]);
        }

        return response()->json([
            'message' => '+1'
        ]);
    }

}
