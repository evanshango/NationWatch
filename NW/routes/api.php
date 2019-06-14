<?php

use Illuminate\Support\Facades\Route;

Route::get('locations', 'LocationController@index');
Route::get('location/{id}/posts', 'LocationController@show');
Route::post('location', 'LocationController@store');
//
Route::get('location-stats', 'LocationStatsController@store');
// authentication
Route::post('user/check', 'AuthController@checkUser');
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('refresh', 'AuthController@refresh');
Route::get('users', 'AuthController@users');
// tags
Route::get('tags', 'TagController@index');
Route::post('tags', 'TagController@store');
Route::get('tags/{id}', 'TagController@show');
Route::put('tags/{id}/edit', 'TagController@update');
Route::delete('tags/{id}/delete', 'TagController@destroy');
// posts
Route::get('posts', 'PostController@index');
Route::get('post/{id}', 'PostController@show');
Route::get('posts/positive', 'PostController@isPositive');
Route::get('posts/non-positive', 'PostController@isNegative');
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
//report posts
Route::get('post-reports', 'ReportsController@reportPosts');
Route::get('comment-reports', 'ReportsController@reportComments');
Route::get('reply-reports', 'ReportsController@reportReplies');
// tag-stats
Route::get('stats', 'TagStatsController@viewStats');
Route::get('tag-stats', 'TagStatsController@updateStats');
Route::get('tag-upvotes', 'TagStatsController@tagUpvotes');
Route::get('tag-downvotes', 'TagStatsController@tagDownvotes');
Route::get('location-upvotes', 'TagStatsController@locationUpvotes');
Route::get('location-downvotes', 'TagStatsController@locationDownvotes');
Route::get('tag/upvotes/negative', 'TagStatsController@negative');
Route::get('tag/downvotes/negative', 'TagStatsController@negativeDownvotes');

Route::middleware('auth:api')->group( function () {
    Route::get('users/me', 'AuthController@index');

    Route::post('logout', 'AuthController@logout');
    Route::delete('account/{id}/delete', 'AuthController@destroy');

    Route::post('posts', 'PostController@store');
    Route::put('post/{id}/edit', 'PostController@update');
    Route::delete('post/{id}/delete', 'PostController@destroy');

    Route::post('comment', 'CommentController@store');
    Route::put('comment/{id}/edit', 'CommentController@update');
    Route::delete('comment/{id}/delete', 'CommentController@destroy');

    Route::post('reply', 'ReplyController@store');
    Route::put('reply/{id}/edit', 'ReplyController@update');
    Route::delete('reply/{id}/delete', 'ReplyController@destroy');

    Route::post('upvote', 'VoteController@doUpvote');
    Route::post('downvote', 'VoteController@doDownvote');

    Route::post('comment+', 'CommentPlusController@store');
    Route::post('reply+', 'ReplyPlusController@store');

    Route::post('report-post', 'ReportsController@reportPost');
    Route::post('report-comment', 'ReportsController@reportComment');
    Route::post('report-reply', 'ReportsController@reportReply');

});
