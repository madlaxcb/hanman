<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2019/2/2
 * Time: 15:29
 */

namespace app\api\controller;

use app\model\Author;
use app\model\Book;
use app\model\Photo;
use think\Controller;
use think\Request;
use app\model\Chapter;
use think\facade\App;

class Index extends Controller
{
    protected $chapterService;
    protected $photoService;

    public function initialize()
    {
        $this->chapterService = new \app\service\ChapterService();
        $this->photoService = new \app\service\PhotoService();
    }

    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->param();
            $book = Book::where('book_name', '=', $data['book_name'])->find();
            if (!$book) {
                $author = Author::where('author_name', '=', $data['author'])->find();
                if (is_null($author)) {//如果作者不存在
                    $author = new Author();
                    $author->author_name = $data['author'];
                    $author->save();
                }
                $book = new Book();
                $book->author_id = $author->id;
                $book->book_name = $data['book_name'];
                $book->tags = $data['tags'];
                $book->src = $data['src'];
                $book->end = $data['end'];
                $book->save();
                $dir = App::getRootPath().'/public/static/upload/book/' . $data['id'];
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $cover = $request->file('cover');
                if ($cover) {
                    $cover->validate(['size' => 1024000, 'ext' => 'jpg,png,gif'])
                        ->move($dir,'cover.jpg');
                }
            }
            $map[] = ['chapter_name', '=', $data['chapter_name']];
            $map[] = ['book_id', '=', $data['book_id']];
            $chapter = Chapter::where($map)->find();
            if (!$chapter) {
                $chapter = new Chapter();
                $chapter->chapter_name = $data['chapter_name'];
                $chapter->book_id = $book->id;
                $lastChapterOrder = 0;
                $lastChapter = $this->chapterService->getLastChapter($book->id);
                if ($lastChapter){
                    $lastChapterOrder = $lastChapter->order;
                }
                $chapter->order = $lastChapterOrder + 1;
                $chapter->save();
            }
            $dir = App::getRootPath() . 'public/static/upload/book/'.$book->id.'/'.$chapter->id;
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $img_urls = explode('|',$data['images']);
            foreach ($img_urls as $img_url){
                $photo = new Photo();
                $photo->chapter_id  = $chapter->id;
                $lastOrder = 0;
                $lastPhoto = $this->photoService->getLastPhoto($chapter->id);
                if ($lastPhoto){
                    $lastOrder = $lastPhoto->order + 1;
                }
                $photo->order = $lastOrder + 1;
                $photo->save();
                $file = file_get_contents($img_url);
                file_put_contents($dir.$photo->id.'.jpg',$file);
            }
        }
    }
}