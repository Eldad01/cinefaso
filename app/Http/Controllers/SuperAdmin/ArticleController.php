<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Article::query()
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->string('type')))
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('superadmin.editorial.index', compact('articles'));
    }

    public function create(): View
    {
        return view('superadmin.editorial.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('articles', 'public');
        }

        Article::create($validated);

        return redirect()->route('superadmin.editorial.index')->with('status', 'article-cree');
    }

    public function edit(Article $article): View
    {
        return view('superadmin.editorial.edit', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('superadmin.editorial.index')->with('status', 'article-modifie');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('superadmin.editorial.index')->with('status', 'article-supprime');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:200'],
            'contenu' => ['required', 'string'],
            'type' => ['required', 'in:actualite,portrait,palmares'],
            'auteur' => ['nullable', 'string', 'max:150'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'publie' => ['sometimes', 'boolean'],
        ]);

        $validated['publie'] = $request->boolean('publie');
        unset($validated['photo']);

        return $validated;
    }
}
