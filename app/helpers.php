<?php

use App\Models\Blog;

if (! function_exists('limitWord')) {
    function limitWord($word){
        $limit = 30;
        if (strlen($word)>$limit){
            return substr($word, 0,$limit)." ...";
        }
        return $word;
    }
}

if (! function_exists('slug')) {
    function slug($word){
        $replace = [
            " "=>"-",
            "."=>"-",
            "_"=>"-",
            "+"=>"-",
            "/"=>"-"
        ];
        return strtolower(strtr($word,$replace));
    }
}

if (! function_exists('viewBlog')) {
    function viewBlog($id){
        $b = Blog::find($id);
        $b->view = $b->view + 1;
        $b->save();
    }
}