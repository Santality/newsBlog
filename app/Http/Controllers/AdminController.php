<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        $all = News::all();
        return view('admin.index', ['all' => $all]);
    }

    public function addNews(){
        $categories = Category::all();
        return view('admin.addNews', ['categories' => $categories]);
    }

    public function createNews(Request $request){
        $request->validate([
            "title" => "required",
            "content" => "required",
            "photo" => 'required|image',
            "category" => "required",
        ], [
            "title.required" => "Поле обязательно для заполнения!",
            "content.required" => "Поле обязательно для заполнения!",
            "photo.required" => "Поле обязательно для заполнения!",
            "photo.image" => "Загрузите изображение!",
            "category.required" => "Поле обязательно для заполнения!",
        ]);

        $name = $request->file('photo')->hashName();
        $path = $request->file('photo')->store('public/news');

        $news = News::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'photo' => $name,
            'category_id' => $request['category'],
            'is_blocked' => 0,
        ]);

        if ($news) {
            return redirect()->back()->with('success', 'Запись добавлена!');
        } else {
            return redirect()->back()->with('error', 'Ошибка добавления!');
        }
    }

    public function block(News $id)
    {
        $id->is_blocked = 1;
        $id->save();
        return redirect()->back()->with('success', 'Новость заблокирована!');
    }

    public function unblock(News $id)
    {
        $id->is_blocked = 0;
        $id->save();
        return redirect()->back()->with('success', 'Новость разблокирована!');
    }

    public function delete(News $id)
    {
        $comm = Comment::where('news_id', $id->id)->delete();
        $like = Like::where('news_id', $id->id)->delete();
        $id->delete();
        return redirect()->back()->with('success', 'Новость удалена!');
    }

    public function editNews(News $id){
        $categories = Category::all();
        return view('admin.editNews', ['item'=>$id, 'categories' => $categories]);
    }

    public function updateNews(Request $request)
    {
        $request->validate([
            "title" => "required",
            "content" => "required",
            "photo" => 'nullable|image',
            "category" => "required",
        ], [
            "title.required" => "Поле обязательно для заполнения!",
            "content.required" => "Поле обязательно для заполнения!",
            "photo.image" => "Загрузите изображение!",
            "category.required" => "Поле обязательно для заполнения!",
        ]);

        $updateInfo = News::find($request['id']);
        if ($request->file('photo')) {
            $name = $request->file('photo')->hashName();
            $path = $request->file('photo')->store('public/news');
            $updateInfo->photo = $name;
        }

        $updateInfo->title = $request['title'];
        $updateInfo->content = $request['content'];
        $updateInfo->category_id = $request['category'];
        $updateInfo->save();

        return redirect()->back()->with('success', 'Данные обновлены!');
    }

    public function userList()
    {
        $users = User::where('id_role', 2)->get();
        return view('admin.users', ['users' => $users]);
    }

    public function blockUser(User $id)
    {
        $id->is_blocked = 1;
        $id->save();
        return redirect()->back()->with('success', 'Пользователь заблокирован!');
    }

    public function unblockUser(User $id)
    {
        $id->is_blocked = 0;
        $id->save();
        return redirect()->back()->with('success', 'Пользователь разблокирован!');
    }
}
