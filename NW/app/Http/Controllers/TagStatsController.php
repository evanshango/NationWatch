<?php

namespace App\Http\Controllers;

use App\Model\Tag;
use App\Model\TagStats;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TagStatsController extends Controller
{
    public function updateStats()
    {
        $tags = Tag::all();

        $tag_stats = new Collection;
        foreach ($tags as $tag) {
            /** @var Builder $query */

            $stats = DB::selectOne("select SUM((select count(*) from upvotes where posts.id = upvotes.post_id) - (select count(*) from downvotes where posts.id = downvotes.post_id)) as points 
from `posts` where `tag1_id` = $tag->id  or `tag2_id` = $tag->id or `tag3_id` = $tag->id");

            /*
                       $query = Post::query();


                        $query->where('tag1_id', '=', $tag->id)
                            ->orWhere('tag2_id', '=', $tag->id)
                            ->orWhere('tag3_id', '=', $tag->id);

                        $query->selectRaw('(select count(*) from upvotes where posts.id = upvotes.post_id) - (select count(*) from downvotes where posts.id = downvotes.post_id) as points');

                        dd($query->toSql());
                        $stats = $query->get()
                            ->map(function ($item) {
                                return $item->points;
                            })->reduce(function ($a, $b) {
                                return $a + $b;
                            });

                        dd($stats);*/

            $tag_stat = new TagStats();
            $tag_stat->tag_id = $tag->id;
            $tag_stat->points = $stats->points ?? 0;
            $tag_stat->save();

            $tag_stats->add($tag_stat);
        }
        return $tag_stats;

    }
}
