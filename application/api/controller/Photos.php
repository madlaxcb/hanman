<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2018/11/9
 * Time: 21:22
 */

namespace app\api\controller;


use app\model\Photo;
use think\Controller;
use think\Request;

class Photos extends Controller
{
    public function save(Request $request){
        if ($request->isPost()){
            $chapter_id = $request->post('chapter_id');
            $pic = new Photo();
            $result = $pic->save(['chapter_id'=>$chapter_id]);
            if ($result){
                return json([
                    'success' => 1,
                    'book_id' => $pic->id
                ]);
            }else{
                return json(['success' => 0,'msg' => '非法操作']);
            }
        }
        return '图片api';
    }
}