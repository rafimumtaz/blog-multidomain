<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Institution;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Fungsi helper untuk dapatkan institution dan article sekaligus
    private function findInstitution($institution)
    {
        return Institution::where('domain', $institution . '.localhost')->firstOrFail();
    }

    private function findArticle($institution, $id)
    {
        $institutionModel = $this->findInstitution($institution);
        return Article::where('institution_id', $institutionModel->id)
                      ->where('id', $id)
                      ->firstOrFail();
    }

    public function index($institution)
    {
        $institutionModel = $this->findInstitution($institution);
        $articles = Article::where('institution_id', $institutionModel->id)->get();

        return view('articles.index', [
            'articles' => $articles,
            'institution' => $institutionModel
        ]);
    }   

    public function create($institution)
    {
        $institutionModel = $this->findInstitution($institution);

        return view('articles.create', [
            'institution' => $institutionModel
        ]);
    }

    public function store(Request $request, $institution)
    {
        $institutionModel = $this->findInstitution($institution);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Article::create([
            'institution_id' => $institutionModel->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('articles.index', ['institution' => $institution->subdomain])
                         ->with('success', 'Artikel berhasil dibuat!');
    }

    public function show($institution, $id)
    {
        $article = $this->findArticle($institution, $id);
        $institutionModel = $this->findInstitution($institution);

        return view('articles.show', [
            'article' => $article,
            'institution' => $institutionModel,
        ]);
    }

    public function edit($institution, $id)
    {
        $article = $this->findArticle($institution, $id);
        $institutionModel = $this->findInstitution($institution);

        return view('articles.edit', [
            'article' => $article,
            'institution' => $institutionModel,
        ]);
    }

    public function update(Request $request, $institution, $id)
    {
        $article = $this->findArticle($institution, $id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $article->update($request->only('title', 'content'));

        return redirect()->route('articles.index', ['institution' => $institution])
                         ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($institution, $id)
    {
        $article = $this->findArticle($institution, $id);
        $article->delete();

        return redirect()->route('articles.index', ['institution' => $institution])
                         ->with('success', 'Artikel berhasil dihapus!');
    }
}
