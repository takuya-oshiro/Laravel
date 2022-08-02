<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usertdb extends Model
{
    //use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'usertdb';

    //変更許可カラム
    protected $fillable =
    [
        'urltoken',
        'mail',
        'flag'
    ];

    /**
     * インサート処理
     * @param string $request['email']
     * @param array $token
     * @return void
     */
    public function insertTdbUser(string $email, string $token)
    {
        $this->urltoken = $token;
        $this->mail = $email;
        $this->flag = 0;
        $this->save();
    }
}
