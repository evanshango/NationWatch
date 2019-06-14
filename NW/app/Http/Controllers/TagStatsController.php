<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagStats\TagStatsCollection;
use App\Model\Tag;
use App\Model\TagStats;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class TagStatsController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function updateStats()
    {
        $tags = Tag::all();

        $tag_stats = new Collection;
        foreach ($tags as $tag) {
            /** @var Builder $query */

            $stats = DB::selectOne("select SUM((select count(*) from upvotes where posts.id = upvotes.post_id) - (select count(*)
            from downvotes where posts.id = downvotes.post_id)) as points
            from `posts` where `tag1_id` = $tag->id  or `tag2_id` = $tag->id or `tag3_id` = $tag->id and `is_positive` = 0");


//            $stats = DB::select("select count(*) from upvotes where posts.id = upvotes.post_id as upvotes,
//            select count(*) from downvotes where posts.id = downvotes.post_id as downvotes
//            from `posts` where `tag1_id` = $tag->id  or `tag2_id` = $tag->id or `tag3_id` = $tag->id and `is_positive` = 1");

//            $query = Post::query();
//            $query->where('tag1_id', '=', $tag->id)
//                ->orWhere('tag2_id', '=', $tag->id)
//                ->orWhere('tag3_id', '=', $tag->id);
//
//            $query->selectRaw('(select count(*) from upvotes where posts.id = upvotes.post_id) - (select count(*) from downvotes where posts.id = downvotes.post_id) as points');
//            dd($query->toSql());
//            $stats = $query->get()
//                ->map(function ($item) {
//                    return $item->points;

            $tag_stat = new TagStats();
            $tag_stat->tag_id = $tag->id;
            $tag_stat->points = $stats->points ?? 0;
            $tag_stat->save();

            $tag_stats->add($tag_stat);
        }
        return response()->json($tag_stats);

    }

    public function viewStats(){
        $stats = TagStats::where('points', '>', 0)->orderBy('points', 'desc')->orderBy('created_at', 'desc')->limit(12)->get();
        return TagStatsCollection::collection($stats);
    }

    public function tagUpvotes(){
        $query = DB::select("SELECT count(upvotes.id) as upvotes, tags.name as tag
FROM upvotes, tags, posts, users
WHERE (upvotes.post_id = posts.id and posts.tag1_id = tags.id and posts.user_id = users.id and 2019 - users.yob < 30  and posts.is_positive = 1) 
	or (upvotes.post_id = posts.id and posts.tag2_id = tags.id and posts.user_id = users.id and 2019 - users.yob < 30 and posts.is_positive = 1)
	or (upvotes.post_id = posts.id and posts.tag3_id = tags.id and posts.user_id = users.id and 2019 - users.yob < 30 and posts.is_positive = 1)
GROUP BY tags.id");

        return response()->json($query);
    }

    public function tagDownvotes(){
        $query = DB::select("SELECT count(downvotes.id) as downvotes, tags.name as tag
FROM downvotes, tags, posts, users
WHERE (downvotes.post_id = posts.id and posts.tag1_id = tags.id and posts.user_id = users.id and 2019 - users.yob < 30  and posts.is_positive = 1) 
	or (downvotes.post_id = posts.id and posts.tag2_id = tags.id and posts.user_id = users.id and 2019 - users.yob < 30 and posts.is_positive = 1)
	or (downvotes.post_id = posts.id and posts.tag3_id = tags.id and posts.user_id = users.id and 2019 - users.yob < 30 and posts.is_positive = 1)
GROUP BY tags.id");

        return response()->json($query);
    }

    public function locationUpvotes(){
        $query = DB::select("SELECT locations.name as location, COUNT(upvotes.id) as upvotes
FROM upvotes, users, locations, posts
WHERE (upvotes.post_id = posts.id and posts.user_id = users.id and users.location_id = locations.id and posts.is_positive = 1) 
GROUP BY locations.id");

        return response()->json($query);
    }

    public function locationDownvotes(){
        $query = DB::select("SELECT locations.name as location, COUNT(downvotes.id) as downvotes
FROM downvotes, users, locations, posts
WHERE (downvotes.post_id = posts.id and posts.user_id = users.id and users.location_id = locations.id and posts.is_positive = 1) 
GROUP BY locations.id");

        return response()->json($query);
    }

    public function negative(){
        $query = DB::select("SELECT COUNT(upvotes.id) as upvotes, tags.name as tag
FROM upvotes, tags, posts
WHERE (upvotes.post_id = posts.id and posts.tag1_id = tags.id and posts.is_positive = 0) 
    or (upvotes.post_id = posts.id and posts.tag2_id = tags.id and posts.is_positive = 0) 
    or (upvotes.post_id = posts.id and posts.tag3_id = tags.id and posts.is_positive = 0) 
GROUP BY tags.id");

        return response()->json($query);
    }

    public function negativeDownvotes(){
        $query = DB::select("SELECT COUNT(downvotes.id) as downvotes, tags.name as tag
FROM downvotes, tags, posts
WHERE (downvotes.post_id = posts.id and posts.tag1_id = tags.id and posts.is_positive = 0) 
    or (downvotes.post_id = posts.id and posts.tag2_id = tags.id and posts.is_positive = 0) 
    or (downvotes.post_id = posts.id and posts.tag3_id = tags.id and posts.is_positive = 0) 
GROUP BY tags.id");

        return response()->json($query);
    }

}
