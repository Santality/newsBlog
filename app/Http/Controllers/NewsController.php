<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(){
        $categories = Category::all();
        $latest_news = News::where('is_blocked', 0)->orderBy('created_at', 'desc')->paginate(4);
        $popular = News::withCount('likeNews')->orderByDesc('like_news_count')->where('is_blocked', 0)->limit(3)->get();
        return view('index', ['categories' => $categories, 'latest' => $latest_news, 'populars' => $popular]);
    }

    public function detailNews(News $id){
        return view('news', ['id' => $id]);
    }

    public function comment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ], [
            'comment.required' => 'Поле должно быть заполнено!',
        ]);

        if (Auth::user()) {
            if (Auth::user()->is_blocked == 1) {
                return redirect()->back()->with('error', 'Ваш аккаунт заблокирован!');
            } else {
                $comment = Comment::create([
                    'news_id' => $request['id'],
                    'user_id' => Auth::user()->id,
                    'comment_text' => $request->comment,
                ]);
                return redirect()->back();
            }
        } else {
            return redirect('/signIn');
        }
    }

    public function like($id)
    {
        if (Auth::user()) {
            if (Auth::user()->is_blocked == 1) {
                return redirect()->back()->with('error', 'Ваш аккаунт заблокирован!');
            } else {
                $existingLike = Like::where('user_id', Auth::user()->id)->where('news_id', $id)->first();
                if ($existingLike) {
                    $existingLike->delete();
                    return redirect()->back();
                } else {
                    $like = Like::create([
                        'news_id' => $id,
                        'user_id' => Auth::user()->id,
                    ]);
                    return redirect()->back();
                }
            }
        } else {
            return redirect('/auth');
        }
    }

    public function list($id)
    {
        $filter = News::where('category_id', $id)->where('is_blocked', 0)->paginate(6);
        $category = Category::find($id);
        return view('category', ['filters' => $filter, 'category' => $category]);
    }
}
