<?php 

namespace App\Traits;

use App\Models\User;

trait Checkable
{
    public static function Checkable(string $email)
    {
        $result = User::where('email',$email)->get();
        if(!empty($result[0]->id)){
            session()->flash('flash_error', 'そのEmailアドレスは既に登録されています。');
            return false;
        }
        return true;
    }
}