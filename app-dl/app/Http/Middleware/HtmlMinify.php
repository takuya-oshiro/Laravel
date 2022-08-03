<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HtmlMinify
{
    /**
     * Handle an incoming request.

     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      // Afterミドルウェアで処理する
      $response = $next($request);

      // HTMLデータを取得
      $content = $response->getContent();

      $pattern = [
        // 改行コードを削除
        "/\n|\r|\r\n/",
        // タグ間の不要空白を削除
        "/(title|head|script|article|div|footer|h[1-5]|ul|ol|li|p|a|i|time|id=\".+?\"|class=\".+?\"|href=\".+?\"|datetime=\".+?\"|alt=\".+?\"|charset=\".+?\"|type=\".+?\")>\s*(.*?)\s*</",
      ];
      $replace = [
        "",
        "$1>$2<",
      ];

      // 置換
      $content = preg_replace($pattern, $replace, $content);

      // 置換したHTMLをセットする
      $response->setContent($content);

      return $response;
    }
}
