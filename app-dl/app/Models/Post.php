<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
//use Illuminate\Support\Facades\DB;


class Post extends Model
{
    //use HasFactory;
    //テーブル名
    protected $table = 'posts';

    //変更許可カラム
    protected $fillable =
    [
        'user_id',
        'post_title',
        'post_content'
    ];

    /**
     * 投稿処理
     * @param array $request
     * @return void
     */
    public function insert(array $request, int $id)
    {
        $this->user_id = $id;
        $this->post_title = $request['post_title'];
        $this->post_content = $request['post_content'];
        $this->save();
    }

    /**
     * 自分がコメントして投稿の取得
     * @return object
     * @param int $user_id
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * コメントしている記事を取得
     * @return object
     * @param int $user_id
     */
    public function to()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 記事のコメントを取得
     * @return object
     * @param int $user_id
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
