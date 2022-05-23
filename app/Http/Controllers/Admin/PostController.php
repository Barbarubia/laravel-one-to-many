<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $validationParameters = [
        'title'         => 'required|max:100',
        'slug'          => 'required|unique:posts|max:105',
        // 'user_id'       => 'required|exists:App\User,id',
        'category_id'   => 'required|exists:App\Category,id|max:30',
        'image'         => 'nullable|url|max:250',
        'content'       => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::where('id', '>', 0);

        if ($request->search) {
            $posts->where('title', 'LIKE', "%$request->search%");
        }

        if ($request->category) {
            $posts->where('category_id', $request->category);
        }

        if ($request->author) {
            $posts->where('user_id', $request->author);
        }

        $posts = $posts->paginate(25);

        $categories = Category::all();

        $users = User::all();

        return view('admin.posts.index', [
            'posts'         => $posts,
            'categories'    => $categories,
            'users'         => $users,
            'request'       => $request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return  view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione dei dati inseriti
        $request->validate($this->validationParameters);

        // Variabile inputForm per richiedere tutti i dati inseriti nel form della pagina posts.create
        $inputForm = $request->all() + [
            'user_id' => Auth::user()->id
        ];

        // Creazione della nuova riga nel database con i dati inseriti nel form
        $newPost = Post::create($inputForm);

        // Redirect al post creato
        return redirect()->route('admin.posts.show', $newPost->slug)->with('created', 'Post created with success!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Ogni user può modificare solo i propri posts
        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Ogni user può aggiornare solo i propri posts
        if (Auth::user()->id !== $post->user_id) abort(403);

        // Validazione dei dati del form modificati ignorando la proprietà "unique" dello slug solo per la risorsa selezionata
        $this->validationParameters['slug'] = [
            'required',
            Rule::unique('posts')->ignore($post),
            'max:105'
        ];

        $request->validate($this->validationParameters);

        // Modifica dei dati nel database
        $inputForm = $request->all();

        $post->update($inputForm);

        // Reindirizzamento alla pagina del post
        return redirect()->route('admin.posts.show', $post->slug)->with('modified', 'Post modified with success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Ogni user può eliminare solo i propri posts
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', 'Post #' . $post->id . ' deleted with success!');;
    }
}
