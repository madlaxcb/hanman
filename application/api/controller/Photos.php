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
            $data = $request->param();
            $pic = new Photo();
            $result = $pic->save([
                'chapter_id' => $data['chapter_id'],
                'order' => $data['order']
            ]);
            if ($result){
                return json([
                    'success' => 1,
                    'pic_id' => $pic->id,
                    'pic_order' => $pic->order
                ]);
            }else{
                return json(['success' => 0,'msg' => '非法操作']);
            }
        }
        return '图片api';
    }
}