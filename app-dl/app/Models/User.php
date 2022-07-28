<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'users';

    //保存する項目
    protected $fillable =
    [
        'name',
        'email',
        'password'
    ];

    /**
     * 投稿を全て取得
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * インサート処理
     * @param object $request
     * @return void
     */
    public function insert(object $request)
    {
        $this->name = $request->nickname;
        $this->email = $request->email;
        $this->password = Hash::make($request->password);
        $this->save();
    }

    /**
     * Update処理
     * @param object $request
     * @return void
     */
    public function updateinfo(object $request, int $id)
    {
        $this->name = $request->nickname;
        $this->password = Hash::make($request->password);
        $this->save();
    }
}
