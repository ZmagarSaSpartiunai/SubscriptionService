<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
    ];

    /**
     * @param string $title
     * @param string $text
     * @param int $userId
     * @return Article
     */
    public static function create(string $title, string $text, int $userId): Article
    {
        $article = new self();
        $article->title = $title;
        $article->text = $text;
        $article->active = false;
        $article->user_id = $userId;
        $article->save();

        return $article->refresh();
    }
}
