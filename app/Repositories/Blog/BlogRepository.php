<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use Spatie\QueryBuilder\QueryBuilder;

class BlogRepository
{
    public function getBlogsPaginated()
    {
        return QueryBuilder::for(Blog::class)
        ->paginate(request()->input("pagination", 10));
    }

    public function getBlogs()
    {
        return QueryBuilder::for(Blog::class)
        ->get();
    }

}
