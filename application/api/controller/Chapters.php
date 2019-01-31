<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/11/9
 * Time: 20:45
 */

namespace app\api\controller;


use think\Controller;
use think\Request;
use app\model\Chapter;

class Chapters extends Controller
{
    public function save(Request $request){
        if ($request->isPost()){
            $data = $request->param();

            $map[] = ['chapter_name','=',$data['chapter_name']];
            $map[] = ['book_id','=',$data['book_id']];
            $chapter = Chapter::where($map)->find();
            if ($chapter){
                return json(['success' => 0,'msg' => '存在同名章节']);
            }
            $chapter = new Chapter();
            $result = $chapter->save($data);
            if ($result){
                return json([
                    'success' => 1,
                    'chapter_id' => $chapter->id,
                    'chapter->order' => $chapter->order
                ]);
            }else{
                return json(['success' => 0,'msg' => '非法操作']);
            }
        }
       return '章节api接口';
    }
}