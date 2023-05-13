<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::first();
    }
    public function index() {
        SEOMeta::setTitle('المقالات' . ' - ' . $this->settings->title);
        OpenGraph::setTitle('المقالات' . ' - ' . $this->settings->title);
        JsonLd::setTitle('المقالات' . ' - ' . $this->settings->title);

        \General::seoCommon();

        $posts = Post::with(['category' => function($q) {
            $q->select('id','title');
        }])->active()->select('id','title', 'summary', 'image', 'slug', 'created_at', 'blogcategory_id')->get();

        return view('front.pages.blog', compact('posts'));
    }

    public function show($slug) {
        $post = Post::with(['category' => function($q) {
            $q->select('id','title', 'slug');
        }])->active()->where('slug', $slug)->first();
        \General::singlePost($slug);
        return view('front.pages.single-post', compact('post'));
    }
}
