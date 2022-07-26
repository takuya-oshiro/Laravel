<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    //use HasFactory;
    protected $table = 'comments';


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

    /**
     * コメント取得
     * @param int $id
     * @return void
     */
    public static function getComment(int $id)
    {
        return DB::table('comments')
        ->leftJoin('users','comments.user_id','=','users.id')
        ->select('users.name', 'comments.comment', 'comments.created_at')
        ->where('comments.id',$id)
        ->get();
    }

    public static function getMyComment(int $post_id, int $user_id)
    {
        return DB::table('comments')
        ->join('users','comments.user_id','=','users.id')
        ->select('comment_id', 'comments.comment', 'users.name', 'comments.updated_at')
        ->where('comments.post_id',$post_id)
        ->where('users.id',$user_id)
        ->get();
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
