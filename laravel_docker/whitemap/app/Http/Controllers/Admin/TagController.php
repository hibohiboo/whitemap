<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use \Illuminate\Validation\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = $request->user();
        //$tags = Tag::orderBy('created_at', 'asc')->get();
        $tags = Tag::paginate(config('const.Paginator.PER_PAGE'));
        return view('admin/tags', [
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 新規作成画面を表示
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {

    // }

    /**
     * Store a newly created resource in storage.
     * 新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'value' => 'required|integer'
        ]);

        $user = $request->user();
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->create_user_id = $user->id;
        $tag->value = $request->value;
        $tag->save();

        return redirect('/tag');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 編集画面を表示
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    // public function edit(Tag $tag)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     * 変更の保存
     * Laravelはタイプヒントされた変数名とルートセグメント名が一致する場合、
     * ルートかコントローラアクション中にEloquentモデルが定義されていると、自動的に依存解決する。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:255',
            'value' => 'required|integer'
        ]);

        $tag->name = $request->name;
        $tag->value = $request->value;
        $tag->save();

        return redirect('/tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Tag $tag)
    // {
    //     //
    // }
}
