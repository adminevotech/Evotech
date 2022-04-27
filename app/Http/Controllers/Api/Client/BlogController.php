<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\BlogResource;
use App\Http\Resources\Blog\ShowBlogResource;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepository;
use Illuminate\Http\Request;

/**
 * @group Blog Module
 */
class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository) {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Get All Blogs
     *
     * @apiResourceCollection App\Http\Resources\Blog\BlogResource
     * @apiResourceModel App\Models\Blog
     */
    public function index(Request $request)
    {
        return ok_response($this->all($request));
    }

    /**
     * Show Blog
     *
     * @header Authorization Bearer Token
     *
     * @apiResource App\Http\Resources\Blog\ShowBlogResource
     * @apiResourceModel App\Models\Blog
     * @responseFile 404 scenario="not found Blog " responses/not_found.json
     * */
    public function show(Blog $blog)
    {
        return ok_response(new ShowBlogResource($blog));
    }

    private function all($request){
        return collectionFormat(BlogResource::class, $this->blogRepository->getBlogs($request));
    }
}
