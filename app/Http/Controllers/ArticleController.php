<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::where('institution_id', $GLOBALS['institution']->id)->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Article::create([
            'institution_id' => $GLOBALS['institution']->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('articles.index', ['institution' => $GLOBALS['institution']->domain]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        $this->authorizeInstitution($article);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $this->authorizeInstitution($article);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        $this->authorizeInstitution($article);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $article->update($request->only('title', 'content'));

        return redirect()->route('articles.index', ['institution' => $GLOBALS['institution']->domain])
                         ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $this->authorizeInstitution($article);
        $article->delete();

        return redirect()->route('articles.index', ['institution' => $GLOBALS['institution']->domain])
                         ->with('success', 'Artikel berhasil dihapus!');
    }

    private function authorizeInstitution(Article $article)
    {
        if ($article->institution_id !== $GLOBALS['institution']->id) {
            abort(403, 'Akses ditolak.');
        }
    }
}
