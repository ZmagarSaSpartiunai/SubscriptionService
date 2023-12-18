<?php

namespace App\Repositories;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Models\Article;
use App\Models\User;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @param int|null $user_id
     * @param bool $onlyActive
     * @return mixed
     */
    public function search(int $user_id = null, bool $onlyActive = true)
    {
        return Article::when($user_id, function ($query, $user_id) {
            return $query->where('user_id', $user_id);
        })->when($onlyActive, function ($query) {
            return $query->where('active', true);
        })->get();
    }

    /**
     * @param User $user
     * @param Article $article
     * @return Article
     */
    public function activateArticle(User $user, Article $article): Article
    {
        $article->active = !$article->active;
        $article->save();

        return $article->refresh();
    }

    /**
     * @param string $title
     * @param string $text
     * @return Article
     */
    public function createArticle(string $title, string $text): Article
    {
        $userId = auth()->user()->id;

        return Article::create($title, $text, $userId);
    }

    /**
     * @param Article $article
     * @param array $attributes
     * @return Article
     */
    public function updateArticle(Article $article, array $attributes): Article
    {
        $article->update($attributes);

        return $article->refresh();
    }
}
