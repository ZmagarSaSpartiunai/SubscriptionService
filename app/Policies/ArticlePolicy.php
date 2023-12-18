<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Article $article
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function show(User $user, Article $article)
    {
        return $user->id = $article->user_id
            ? Response::allow()
            : Response::deny('You do not own this article.');
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Article $article
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id
            ? Response::allow()
            : Response::deny('You do not own this article.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Article $article
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id
            ? Response::allow()
            : Response::deny('You do not own this article.');
    }
    public function activate(User $user, Article $article)
    {
        $checkOwner = $this->update($user, $article);
        if ($checkOwner->denied()) return $checkOwner;

        if (!$user->activeUserSubscription()->exists())
            return Response::deny('You cannot publish an article because you don`t have a paid subscription.');

        if ($article->active || $user->activeUserSubscription()->first()->subscription->article_quota > $user->articles->where('active', true)->count()) {
            return Response::allow();
        } else {
            return Response::deny('The article cannot be published because the limit of active articles has been reached.');
        }
    }
}
