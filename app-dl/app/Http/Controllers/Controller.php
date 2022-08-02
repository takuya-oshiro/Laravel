<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Post;
use App\Models\User;
use App\Models\Usertdb;
use App\Models\Comment;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Post    $Post;
    protected Usertdb $Usertdb;
    protected User    $User;
    protected Comment $Comment;

    public function __construct(Post $post, Usertdb $Usertdb, User $User, Comment $Comment)
    {
        $this->Post = $post;
        $this->Usertdb = $Usertdb;
        $this->User = $User;
        $this->Comment = $Comment;
    }
}
