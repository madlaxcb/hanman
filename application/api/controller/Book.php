<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2019/1/31
 * Time: 14:27
 */

namespace app\api\controller;


use think\Controller;
use think\Request;
use app\model\Author;
use app\model\Book as BookModel;

class Book extends Controller
{
    public function save(Request $request){
        if ($request->isPost()) {
            $data = $request->param();

            $book = BookModel::where('book_name', '=', $data['book_name'])->find();
            if ($book) {
                return json(['success' => 0,'msg' => '存在同名漫画']);
            }

            //作者处理
            $author = Author::where('author_name','=',$data['author'])->find();
            if (is_null($author)) {//如果作者不存在
                $author = new \app\model\Author();
                $author->author_name = $data['author'];
                $author->save();
            }
            $book->author_id = $author->id;
            $book->book_name = $data['book_name'];
            $result = $book->save($data);
            if ($result){
                return json([
                    'success' => 1,
                    'book_id' => $book->id
                ]);
            }else{
                return json(['success' => 0,'msg' => '非法操作']);
            }
        }
        return '书本api接口';
    }
}