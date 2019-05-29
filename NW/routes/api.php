<?php

use Illuminate\Support\Facades\Route;

Route::get('location', 'LocationController@index');
Route::post('location', 'LocationController@store');
// authentication
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('refresh', 'AuthController@refresh');
Route::get('users', 'AuthController@index');
// tags
Route::get('tags', 'TagController@index');
Route::post('tags', 'TagController@store');
Route::get('tags/{id}', 'TagController@show');
Route::put('tags/{id}/edit', 'TagController@update');
Route::delete('tags/{id}/delete', 'TagController@destroy');
// posts
Route::get('posts', 'PostController@index');
Route::get('post/{id}', 'PostController@show');
//comments
Route::get('comments', 'CommentController@index');
Route::get('comment/{post_id}', 'CommentController@show');
// replies
Route::get('replies', 'ReplyController@index');
Route::get('replies/{comment_id}', 'ReplyController@show');
//votes
Route::get('upvotes', 'VoteController@upvote');
Route::get('downvotes', 'VoteController@downvote');
//comment plus one
Route::get('comment+', 'CommentPlusController@index');
//reply plus one
Route::get('reply+', 'ReplyPlusController@index');

Route::middleware('auth:api')->group( function () {
    Route::post('logout', 'AuthController@logout');
    Route::delete('account/{id}/delete', 'AuthController@destroy');

    Route::post('posts', 'PostController@store');
    Route::put('post/{id}/edit', 'PostController@update');
    Route::delete('post/{id}/delete', 'PostController@destroy');

    Route::post('comment', 'CommentController@store');
    Route::put('comment/{id}/edit', 'CommentController@update');
    Route::delete('comment/{id}/delete', 'CommentController@destroy');

    Route::post('replies', 'ReplyController@store');
    Route::put('reply/{id}/edit', 'ReplyController@update');
    Route::delete('reply/{id}/delete', 'ReplyController@destroy');

    Route::post('upvote', 'VoteController@doUpvote');
    Route::post('downvote', 'VoteController@doDownvote');

    Route::post('comment+', 'CommentPlusController@store');
    Route::post('reply+', 'ReplyPlusController@store');

});
