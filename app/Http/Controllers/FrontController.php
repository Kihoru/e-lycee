<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Validator;

class FrontController extends Controller
{

    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    public function index()
    {
        $lastPost = $this->post->with('user', 'comments')->orderBy('id', 'desc')->take(1)->where("status", 1)->get();
        $latestPosts = $this->post->with('user', 'comments')->orderBy('id', 'desc')->skip(1)->take(4)->where("status", 1)->get();
        $sidePosts = $this->post->with('user', 'comments')->orderBy('id', 'desc')->skip(5)->take(2)->where("status", 1)->get();
        return view("school.parts.index", compact("lastPost", "latestPosts", "sidePosts"));
    }

    public function oneActu($id)
    {
        $post = $this->post->with('user', 'comments')->findOrFail($id);

        return view("school.parts.actuOne", compact("post"));
    }

    public function addComment(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'content' => 'required|max:400'
        ]);

        if($v->fails()) {
            return redirect('/actuOne/'.$id)
                        ->withErrors($v)
                        ->withInput();
        }else{
            $datas = $request->all();
        }

        $captchaRes = $datas["g-recaptcha-response"];
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $secret = env("CAPTCHA_SECRET");

        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
	    . $secret
	    . "&response=" . $captchaRes
	    . "&remoteip=" . $user_ip ;

        $decode = json_decode(file_get_contents($api_url), true);

    	if ($decode['success'] == true) {
            $this->comment->username = htmlspecialchars($datas["username"]);
            $this->comment->content = htmlspecialchars($datas["content"]);
            $this->comment->post_id = $id;

            if(!$this->comment->save()) {
                return redirect('/actuOne/'.$id)
                            ->withErrors(["error" => "La sauvegarde de votre commentaire n'a pas été bien effectué."])
                            ->withInput();
            }else{
                return redirect('/actuOne/'.$id);
            }
    	}else{
            return redirect('/actuOne/'.$id)
                        ->withErrors(["error" => "Veuillez bien saisir le captcha"])
                        ->withInput();
        }
    }

    public function actus()
    {
        $posts = $this->post->with('user', 'comments')->orderBy('id', 'desc')->paginate(5);
        $sidePosts = $this->post->with('user', 'comments')->orderBy('id', 'desc')->skip(5)->take(2)->where("status", 1)->get();
        return view("school.parts.actus", compact('posts', 'sidePosts'));
    }

    public function contact()
    {
        $sidePosts = $this->post->with('user', 'comments')->orderBy('id', 'desc')->skip(5)->take(2)->where("status", 1)->get();
        return view("school.parts.contact", compact('sidePosts'));
    }

    public function lycee()
    {
        $sidePosts = $this->post->with('user', 'comments')->orderBy('id', 'desc')->skip(5)->take(2)->where("status", 1)->get();
        return view("school.parts.lycee", compact('sidePosts'));
    }

    public function mlegales()
    {
        return view("school.parts.mlegales");
    }
}
