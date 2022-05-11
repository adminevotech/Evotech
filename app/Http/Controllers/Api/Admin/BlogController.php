<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\StoreBlog;
use App\Http\Requests\Admin\Blog\UpdateBlog;
use App\Http\Resources\Blog\BlogResource;
use App\Http\Resources\Blog\ShowBlogResource;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepository;
use App\Services\BlogService;
use Illuminate\Http\Request;


/**
 * @group Admin Blog Module
 */
class BlogController extends Controller
{
    protected $blogRepository;
    protected $blogService;

    public function __construct(BlogRepository $blogRepository, BlogService $blogService) {
        $this->authorizeResource(Blog::class, "blog");
        $this->blogRepository = $blogRepository;
        $this->blogService = $blogService;
    }

    /**
     * Get All Blogs
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Blog\BlogResource
     * @apiResourceModel App\Models\Blog paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     */
    public function index()
    {
        return ok_response($this->all());
    }

    /**
     * Create Blog
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection 201 App\Http\Resources\Blog\BlogResource
     * @apiResourceModel App\Models\Blog paginate=10
     * @responseFile 422 scenario="invalid data passed" responses/unprocessable_entity.json
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * */
    public function store(StoreBlog $request)
    {
        $this->blogService->createBlog($request);
        return created_response($this->all());
    }

    /**
     * Show Blog
     *
     * @header Authorization Bearer Token
     *
     * @apiResource App\Http\Resources\Blog\ShowBlogResource
     * @apiResourceModel App\Models\Blog paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Blog" responses/not_found.json
     * */
    public function show(Blog $blog)
    {
        return ok_response(new ShowBlogResource($blog));
    }

    /**
     * Update Blog
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Blog\BlogResource
     * @apiResourceModel App\Models\Blog paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Blog" responses/not_found.json
     * */
    public function update(UpdateBlog $request, Blog $blog)
    {
        $this->blogService->updateBlog($request, $blog);
        return ok_response($this->all());
    }

    /**
     * Delete Blog
     *
     * @header Authorization Bearer Token
     *
     * @apiResourceCollection App\Http\Resources\Blog\BlogResource
     * @apiResourceModel App\Models\Blog paginate=10
     * @responseFile 401 scenario="unauthorized" responses/unauthorized.json
     * @responseFile 403 scenario="not allowed to perform this action" responses/forbidden.json
     * @responseFile 404 scenario="not found Blog" responses/not_found.json
     * */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return ok_response($this->all());
    }

    private function all(){
        return paginatedCollectionFormat(BlogResource::class, $this->blogRepository->getBlogs());
    }
}
