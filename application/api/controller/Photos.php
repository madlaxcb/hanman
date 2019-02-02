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
use think\facade\App;

class Photos extends Controller
{
    public function save(Request $request){
        if ($request->isPost()){
            $data = $request->param();
            $order = $data['order'];
            $pic = new Photo();
            $result = $pic->save([
                'chapter_id' => $data['chapter_id'],
                'order' => $order
            ]);
            if ($result){
                $files = $request->file('image');
                foreach($files as $file){
                    $photo = new Photo();
                    $photo->chapter_id = $data['chapter_id'];
                    $photo->order = $order;
                    $result = $photo->save();
                    if ($result){
                        $dir = App::getRootPath() . 'public/static/upload/book/'.$data['book_id'].'/'.$data['chapter_id'];
                        if (!file_exists($dir)){
                            mkdir($dir,0777,true);
                        }
                        $file->validate(['size'=>2048000,'ext'=>'jpg,png,gif'])->move($dir,$photo->id.'.jpg');
                    }
                    $order++;
                }
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