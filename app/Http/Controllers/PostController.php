<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;





class PostController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        // $user = Auth::user();

        $posts = Post:: all();
        // dd($user);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('uploads/posts', 'public');
                $imagePaths[] = $path;             }
        }

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' =>  json_encode($imagePaths),
        ]);


        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
 $images = json_decode($post->image, true);
    return view('posts.show', compact('post', 'images'));
    }

    public function edit(Post $post)
    {

 $images = json_decode($post->image, true);
        return view('posts.edit', compact('post','images'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->update($request->only(['title', 'description']));

        $oldImages = json_decode($post->image, true) ?? [];
        $newImages = [];

        if ($request->hasFile('images')) {
            foreach ($oldImages as $oldImage) {
                Storage::delete('public/' . $oldImage);
            }

            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');
                $newImages[] = $path;
            }

            $post->update(['image' => json_encode($newImages)]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }




    public function destroy(Post $post)
    {
        $images = json_decode($post->image, true);

        if (!empty($images)) {
            foreach ($images as $imagePath) {
                Storage::delete('public/' . $imagePath);
            }
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    public function deleteAllPosts()
{
    $this->authorize('deleteAllPosts', User::class);
    DB::table('posts')->delete();
    return redirect()->route('posts.index')->with('success', 'All posts deleted successfully!');
}
}
