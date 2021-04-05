<?php
if (! function_exists('limitWord')) {
    function limitWord($word){
        $limit = 30;
        if (strlen($word)>$limit){
            return substr($word, 0,$limit)." ...";
        }
        return $word;
    }
}