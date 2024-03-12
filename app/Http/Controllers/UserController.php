<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect("/");
    }

    public function signUp(Request $request)
    {
        $request->validate([
            "username" => "required",
            "email" => "required|unique:users|email",
            "password" => "required|min:8",
            "password_confirm" => "required|same:password|min:8",
        ], [
            "username.required" => "Поле обязательно для заполнения!",
            "email.required" => "Поле обязательно для заполнения!",
            "password.required" => "Поле обязательно для заполнения!",
            "password.min" => "Поле должно содержать не менее 8 символов!",
            "password_confirm.required" => "Поле обязательно для заполнения!",
            "password_confirm.min" => "Поле должно содержать не менее 8 символов!",
            "email.unique" => "Данная почта уже занята!",
            "email.email" => "Неверный формат электронной почты!",
            "password_confirm.same" => "Пароли не совпадают!",

        ]);

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'id_role' => 2,
            'is_blocked' => 0,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            Auth::login($user);
            return redirect('/')->with('success', 'Успешная регистрация!');
        } else {
            return redirect()->back()->with('error', 'Ошибка регистрации!');
        }
    }

    public function signIn(Request $request)
    {
        $request->validate([
            "userdata" => "required",
            "password" => "required",
        ], [
            "userdata.required" => "Поле обязательно для заполнения!",
            "password.required" => "Поле обязательно для заполнения!",
        ]);

        $field = filter_var($request->userdata, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([
            $field => $request['userdata'],
            "password" => $request['password'],
        ])) {
            if (Auth::user()->id_role == 1) {
                return redirect('/admin')->with('success', 'Здраствуй, администратор!');
            }
            return redirect('/')->with('success', 'Успешая авторизация!');
        } else {
            return redirect()->back()->with('error', 'Ошибка авторизации!');
        }
    }

    public function profile(){
        $likes = Like::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        return view('profile', ['likes' => $likes, 'comments' => $comment]);
    }

    public function editProfile(Request $request){
        $request->validate([
            "username" => "unique:users,username," . Auth::user()->id,
            "email" => "unique:users,email," . Auth::user()->id,
            "password" => "nullable|min:8",
        ], [
            "username.unique" => "Данный логин занят!",
            "email.unique" => "Данная почта занята!",
            "password.min" => "Поле должно содержать не менее 8 символов!",
        ]);

        $updateInfo = User::find(Auth::user()->id);
        if (!empty($request['password'])) {
            $updateInfo->password = Hash::make($request['password']);
        }
        $updateInfo->username = $request['username'];
        $updateInfo->email = $request['email'];
        $updateInfo->save();

        return redirect()->back()->with('success', 'Данные обновлены!');
    }
}
