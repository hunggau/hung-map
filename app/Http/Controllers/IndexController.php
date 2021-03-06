<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Exception;
use App\Helpers\Cms;
use App\Repositories\CategoryRepository;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IndexController extends Controller 
{
    public function __construct(CategoryRepository $categoriesRepo) 
    {        
        $this->categoriesRepo = $categoriesRepo;
    }
    
    public function getIndex()
    {   
        $query = Post::orderBy('posts.created_at', 'desc')
                ->where('type', '=', 'post')
                ->whereIn('posts.status', [Cms::Active]);
        
        if ($search = request('search')) {
            $query->where('posts.title', 'LIKE', '%' . addslashes($search) . '%');
        }
        
        if  ($month = request('month')) {            
            $query->whereMonth('created_at', '=', Carbon::parse($month)->month);
        }
        
        if  ($year = request('year')) {
            $query->whereYear('created_at', '=', $year);
        }
        
        $query->select([
            'posts.*'
        ]);
        
        return view('frontend.index.welcome', [
            'posts' => $query->simplePaginate(10),
            'tree' => $this->getCategoryTree()
        ]);
    }
    
    public function getCategory($slug, $categoryId)
    {   
        $search = isset($request->search) ? trim($request->search) : "";
        
        $query = Post::orderBy('posts.created_at', 'desc')
                ->where('type', '=', 'post')
                ->whereIn('posts.status', [Cms::Active]);
        
        if ($search != "") {
            $query->where('posts.title', 'LIKE', '%' . addslashes($search) . '%');
        }
        
        if (trim($categoryId) != "") {
            $query->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
                ->where('post_categories.category_id', '=', $categoryId );
        }
        
        $query->select([
            'posts.*'
        ]);
        
        $category = Category::where('id', '=', $categoryId)->first();
        
        return view('frontend.index.welcome', [
            'posts' => $query->simplePaginate(10),
            'tree' => $this->getCategoryTree(),
            'category' => $category
        ]);
    }
    
    public function getTag($slug = '')
    {           
        $search = isset($request->search) ? trim($request->search) : "";
        
        $query = Post::orderBy('posts.created_at', 'desc')
                ->where('type', '=', 'post')->whereIn('posts.status', [Cms::Active]);
        
        if ($search != "") {
            $query->where('posts.title', 'LIKE', '%' . addslashes($search) . '%');
        }
        
        if (trim($slug) != "") {           
            $query->join('post_tags', 
                    'post_tags.post_id', '=', 'posts.id')
                  ->join('tags', 
                    'post_tags.tag_id','=', 'tags.id')
                ->where('tags.slug', '=', $slug );
        }
        
        $query->select([
            'posts.*'
        ]);
        
        $tag = Tag::where('slug', '=', $slug)->first();
        
        return view('frontend.index.welcome', [
            'posts' => $query->simplePaginate(10),
            'tree' => $this->getCategoryTree(),
            'tag' => $tag   
        ]);
    }
    
    public function getAbout()
    {
        $slug = 'about';  
        
        $post = Post::where('slug', $slug)->first();
        
        return view('frontend.index.about', [
            'title' => 'Giới thiệu',
            'post' => $post,
            'tree' => $this->getCategoryTree()
        ]);
    }
    
    public function getContact()
    {
        return view('frontend.index.contact', [
            'title' => 'Liên hệ',
            'tree' => $this->getCategoryTree()
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPost(Request $request, $slug = '', $id = 0)
    {        
        try {
            $post = Post::where('id', $id)->first();
            if (! $post) {
                throw new Exception('Page not found');
            }
            $preview = false;
            
            if ($post->status == Cms::Draft && $request->preview == '1') {
                 $loginUser = $request->user();
                 if (! isset($loginUser->id) ) {
                     throw new Exception('Page not found');
                 } else {
                     $preview = true;
                 }
            }
            
            $objs = DB::select('SELECT MAX(id) AS id
                    FROM posts
                    WHERE id < ?
                    UNION 
                    SELECT MIN(id) AS id
                    FROM posts
                    WHERE id > ? AND status = ? ', [$post->id, $post->id, Cms::Active]);
            
            $ids = [];
            foreach ($objs as $item) {
                $ids[] = $item->id;
            }
            $postsPn = Post::whereIn('id',$ids)->orderBy('id', 'ASC')->get();
            
            return view('frontend.index.post', [
                'title' => $post->title,
                'post' => $post,
                'preview' => $preview,
                'tree' => $this->getCategoryTree(),
                'postsPn' => $postsPn
            ]);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    private function getCategoryTree()
    {
        $tree = Category::tree(0, 'post');     
        $tree = $this->categoriesRepo->displayCategory(
                $tree, false, [], '/post/category/');
        
        return $tree;
    }
}