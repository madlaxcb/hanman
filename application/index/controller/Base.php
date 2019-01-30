<?php
/**
 * Created by PhpStorm.
 * User: zhangxiang
 * Date: 2018/10/19
 * Time: 下午1:16
 */

namespace app\index\controller;


use app\model\FriendshipLink;
use think\App;
use think\Controller;
use think\facade\View;

class Base extends Controller
{
    protected $tpl;
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        if (isMobile()){
            $this->tpl = $this->request->action();
        }else{
            $this->tpl = 'pc_'.$this->request->action();
        }
        $links = cache('friendship_link');
        if ($links == false){
            $links = FriendshipLink::all();
            cache('friendship_link',$links);
        }
        View::share([
            'url' => config('site.url'),
            'site_name' => config('site.site_name'),
            'img_site' => config('site.img_site'),
            'links' => $links
        ]);
    }
}