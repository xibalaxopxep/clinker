<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Frontend {
    public function handle($request, Closure $next){
        $config = \DB::table('config')->first();
        $menu = \DB::table('menu')->where('parent_id', 0)->get();
        foreach($menu as $key=>$val){
            $menu[$key]->children = \DB::table('menu')->where('parent_id',$val->id)->get();
        }
        $template_setting= \DB::table('template_setting')->join('template_attribute','template_setting.attribute_id','=','template_attribute.id')->select('template_setting.name','template_setting.value','template_attribute.title')->get();
        $news_footer1 = \DB::table('news')->join('news_category', 'news.id', '=', 'news_category.news_id')->where('news_category.category_id',238)->where('status',1)->select('news.*')->orderBy('news.ordering')->get();
        $news_footer2 = \DB::table('news')->join('news_category', 'news.id', '=', 'news_category.news_id')->where('news_category.category_id',239)->where('status',1)->select('news.*')->orderBy('news.ordering')->get();
        $template=[];
        foreach($template_setting as $key=>$val){
            $template[$val->name][$val->title]=$val->value;
        }
        $count=0;
        if(! is_null(session('cart'))){
            foreach(session('cart') as $val){
                    $count += $val['quantity'];
            }
        }
        \View::share(['share_config' => $config]);
        \View::share(['count_cart' => $count]);
        \View::share(['menu' => $menu]);
        \View::share(['news_footer1' => $news_footer1]);
        \View::share(['news_footer2' => $news_footer2]);
        \View::share(['template' => $template]);
        return $next($request);
    }
    
}
