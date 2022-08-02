<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Illuminate\Support\Facades\DB;


class Post extends Model
{
    //use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
     * 記事のコメントを取得
     * @return object
     * @param int $user_id
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * ソフトデリートの同期
     * コメントした投稿がdeleteされたらコメントもdeleteする
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::deleted(function ($post) {
            $post->comments()->delete();
        });
    }

    /**
     * 自分がコメントしている投稿とそのコメントを取得
     *
     * @param [type] $user_id
     * @return void
     */
    public function getCommentAndPost($user_id){
        return Post::with('comments')
        ->whereHas('comments', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        })->Paginate(5);            
    }
}
