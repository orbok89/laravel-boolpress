<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $request->validate([
            'title'=>'required|max:255',
            'content'=> 'required',
            'category_id'=>'nullable|exists:categories,id' ,
            'tags'=>'exists:tags,id'
        ]);
         
        $form_data=$request->all();
        $new_post = new Post();

        $new_post->fill($form_data);

        $slug = Str::slug($new_post->title, '-');

        $slug_presente = Post::where('slug', $slug)->first();
        $contatore = 1;
        while($slug_presente){
            $slug = $slug . '-' . $contatore;
            $slug_presente = Post::where('slug', $slug)->first();
            $contatore++;
        }

        $new_post->slug = $slug;
        $new_post->save();
        $new_post->tags()->attach($form_data['tags']);

        return redirect()->route('admin.posts.index')->with('inserted', 'Il record è stato correttamente salvato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if(!$post){
            abort(404);
        }return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug)
    {
        $post = Post::where('slug', $slug)->first();
        if(!$post){
            abort(404);
        }
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=> 'required',
            'tags'=>'nullable|exists:tags,id',
        ]);
		
        $form_data = $request->all();
        if($form_data['title'] != $post->title){
            $slug = Str::slug($form_data['title'], '-');				
		     $slug_presente = Post::where('slug', $slug)->first();
            $contatore = 1;
            while($slug_presente){
                $slug = $slug . '-' . $contatore;
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            }
						
					 
            $form_data['slug'] = $slug;
        }
				
			 
        $post->update($form_data); 
        if(array_key_exists('tags', $form_data)){
            $post->tags()->sync($form_data['tags']);
        }else{
            $post->tags()->sync([]);
        }
        return redirect()->route('admin.posts.index')->with('updated', 'Post correttamente aggiornato');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

          $post->tags()->detach($post->id);
        $post->delete();
      
        return redirect()->route('admin.posts.index')->with('deleted', 'Post eliminato');
        
    }
}
