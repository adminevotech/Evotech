<?php

namespace App\Services;

use App\Constants\Media_Collections;
use App\Models\Blog;

class BlogService
{
    public function createBlog($request)
    {
        $blog = Blog::create($request->validated());
        add_media_item($blog, $request->photo, Media_Collections::BLOG_COVER);
        add_media_item($blog, $request->photo, Media_Collections::BLOG_PHOTO);

    }

    public function updateBlog($request, $blog)
    {
        $blog->update($request->validated());
        add_media_item($blog, $request->photo, Media_Collections::BLOG_COVER);
        add_media_item($blog, $request->photo, Media_Collections::BLOG_PHOTO);
    }
}
