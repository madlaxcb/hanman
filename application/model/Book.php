<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/9/30
 * Time: 15:31
 */

namespace app\model;

use think\Model;

class Book extends Model
{
    protected $pk = 'id';
    protected $autoWriteTimestamp = true;

    public static function init()
    {
        self::event('after_insert', function ($book) {
            cache('newest_homepage_mobile',null);
            cache('hot_homepage_mobile',null);
            cache('ends_homepage_mobile',null);
            cache('newest_homepage_pc',null);
            cache('hot_homepage_pc',null);
            cache('ends',null);
        });

        self::event('after_update', function ($book){
            cache('book' . $book->id,null);
            cache('book' . $book->id . 'tags',null);
        });
    }

    public function author()
    {
        return $this->belongsTo('Author');
    }

    public function chapters(){
        return $this->hasMany('chapter');
    }

    public function setBookNameAttr($value){
        return trim($value);
    }

    public function setTagsAttr($value){
        return trim($value);
    }

    public function setSummaryAttr($value){
        return trim($value);
    }

    public function setSrcAttr($value){
        return trim($value);
    }
}