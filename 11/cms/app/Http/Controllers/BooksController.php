<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Books;
use Validator;

class BooksController extends Controller
{
    //コンストラクタ（このクラスが呼ばれたら最初に処理をする箇所）
    public function __construct()
    {
        $this->middleware('auth');
    }

    //本ダッシュボード表示
    public function index()
    {
        $books = Books::orderBy('created_at', 'asc')->get();
        return view('books', [
            'books' => $books
        ]);
    }
    
    //登録
    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|min:3|max:255',
            'item_amount' => 'required|max:3|min:1',
            'item_number' => 'required|max:6',
            'published' => 'required',
        ]);
        //バリデーション：エラー
        if ($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }
        // Eloquent モデル
        $books = new Books;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save(); //「/」ルートにリダイレクト
        return redirect('/');
    }
    
    //更新画面
    public function edit(Books $books)
    {
        return view('booksedit', [
            'book' => $books
        ]);
    }
    
    //更新
    public function update(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required',
        ]);
        //バリデーション：エラー
        if ($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }
        //データ更新
        $books = Books::find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/');
    }
    
    //削除処理
    public function destroy(Books $book)
    {
        $book->delete();
        return redirect('/');
    }
}
