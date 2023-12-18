<?php

namespace App\Contracts\Repositories;

use App\Models\Article;
use App\Models\User;

interface ArticleRepositoryInterface
{
    public function search(int $user_id = null, bool $onlyActive = true);
    public function activateArticle(User $user, Article $article): Article;
    public function createArticle(string $title, string $text): Article;
    public function updateArticle(Article $article, array $attributes): Article;
}
