<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';
    protected $dates = ['deleted_at'];

    //変更許可カラム
    protected $fillable = 
    [
        'user_id',
        'post_id',
        'comment',
        'deleted_at'
    ];

    /**
     * 投稿処理
     * @param object $request
     * @return void
     */
    public function insert(int $user_id, int $post_id, string $comment)
    {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->comment = $comment;
        $this->save();
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
