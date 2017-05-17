<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use Carbon\Carbon;
use App\Article;
use App\Tag;
use App\Http\Requests;

class ArticleController extends Controller
{
    //
    public function index()
    {
        // $articles = Article::all();
        // $articles = Article::latest()->get();
        // $articles = Article::where('published_at','<=',Carbon::now())->latest()->get();
        $articles = Article::latest()->published()->get();
         return view('articles.index',compact('articles'));
    }

    public function show($id)
    {
        $article = Article::find($id);
        if (is_null($article)) {
            abort(404);
        }
       return view('articles.show',compact('article'));
    }

    public function create()
    {
        // return view('articles.create');
        // $tags = Tag::lists('name', 'id');
        $tags = Tag::pluck('name', 'id');
        //为了在界面中显示标签name，id为了在保存文章的时候使用。
        return view('articles.create',compact('tags'));
    }

    public function store(Requests\StoreArticleRequest $request)
    {

      $input = $request->all();
      $input['intro'] = mb_substr($request->get('content'),0,64);
      $article = Article::create($input);
      $article->tags()->attach($request->input('tag_list'));
      return redirect('/');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $tags = Tag::pluck('name', 'id');
        return view('articles.edit',compact('article','tags'));
    }

    public function update(Requests\StoreArticleRequest $request)
    {
        //根据id查询到需要更新的article
        $article = Article::find($request->get('id'));
        //使用Eloquent的update()方法来更新，
        //request的except()是排除某个提交过来的数据，我们这里排除id
        $article->update($request->except('id'));
        // 跟attach()类似，我们这里使用sync()来同步我们的标签
        $article->tags()->sync($request->get('tag_list'));

        return redirect('/');
    }
}
