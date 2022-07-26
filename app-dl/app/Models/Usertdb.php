<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertdb extends Model
{
    //use HasFactory;
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
     * @param array $request
     * @return void
     */
    public function insertTdbUser(array $request)
    {
        $this->urltoken = $request['urltoken'];
        $this->mail = $request['email'];
        $this->flag = 0;
        $this->save();
    }
}
