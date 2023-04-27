<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Services\FileHandlerService;

class PostController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct(private FileHandlerService $fileService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'posts' => Post::select('id', 'title', 'description', 'image')->get(10),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $this->fileService->handleUpload($data['image'], Post::$imagePath);
        }

        return response([
            'post' => Post::create($data),
            'message' => trans('Post Created'),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response([
            'post' => $post,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $this->fileService->handleUpload($data['image'], Post::$imagePath);
        }
        $post->update($request->validated());

        return response([
            'post' => $post->refresh(),
            'message' => trans('Post Updated'),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image !== null) {
            $this->fileService->handleRemove($post->image);
        }
        $post->delete();

        return response([
            'message' => trans('Post Deleted'),
        ], 200);
    }
}
