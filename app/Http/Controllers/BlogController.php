<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormPostRequest;

class BlogController extends Controller
{

    public function create() {
        $post = new Post();
        return view('blog.create', [
            'post' => $post
        ]);
    }

    public function store(FormPostRequest $request) {
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été sauvegardé");
    }

    public function edit(Post $post) {
        return view('blog.edit', [
            'post' => $post,
        ]);
    }

    public function update(Post $post, FormPostRequest $request) {
        $data = $request->validated();
        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('blog', 'public');
        }
        $post->update($data);
        $post->update($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été modifié");
    }

    public function index () : View {
        return view('blog.index', [
            'posts' => Post::paginate(3)
        ]);
    }

    public function show(string $slug, Post $post): RedirectResponse | View
    {
        if ($post->slug =! $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view('blog.show', [
            'post' => $post
        ]);
    }

}
