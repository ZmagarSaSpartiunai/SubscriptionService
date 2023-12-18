<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $repository)
    {
        $this->articleRepository = $repository;
    }

    /**
     * @return Article[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        return $this->articleRepository->search($request->input('user_id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreArticleRequest $request
     * @return Article
     */
    public function store(StoreArticleRequest $request): Article
    {
        return $this->articleRepository->createArticle($request->title, $request->text);
    }

    /**
     * @return mixed
     */
    public function show()
    {
        $userId = \auth()->user()->id;

        return $this->articleRepository->search($userId, false);
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return Article
     * @throws AuthorizationException
     */
    public function activate(Request $request, Article $article): Article
    {
        $this->authorize('activate', $article);

        return $this->articleRepository->activateArticle($request->user(), $article);
    }


    /**
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return bool
     * @throws AuthorizationException
     */
    public function update(UpdateArticleRequest $request, Article $article): Article
    {
        $this->authorize('update', $article);

        return $this->articleRepository->updateArticle($article, $request->input());
    }

    /**
     * @param Article $article
     * @return bool|null
     * @throws AuthorizationException
     */
    public function destroy(Article $article): ?bool
    {
        $this->authorize('delete', $article);

        return $article->delete();
    }
}
