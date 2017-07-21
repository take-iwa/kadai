<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<!-- Bootstrap の定形コード… -->
<div class="panel-body">
    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->
    <!-- 本登録フォーム -->
    <form action="{{ url('books') }}" method="POST"
        class="form-horizontal">
        {{ csrf_field() }}
        <!-- 本のタイトル -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <label for="book" class="control-label">本タイトル</label>
                <input type="text" name="item_name" id="book-name" class="form-control">
                <label for="book" class="control-label">金額</label>
                <input type="number" name="item_amount" id="book-amount" class="form-control">
                <label for="book" class="control-label">数</label>
                <input type="number" name="item_number" id="book-number" class="form-control">
                <label for="book" class="control-label">公開日</label>
                <input type="date" name="published" id="published" class="form-control">
            </div>
        </div>
            <!-- 本 登録ボタン -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-plus"></i> Save
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Book: 既に登録されてる本のリスト -->
<!-- 現在の本 -->
@if (count($books) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        現在の本
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
                <!-- テーブルヘッダ -->
            <thead>
                <th>本一覧</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <!-- 本タイトル -->
                    <td class="table-text">
                        <div>{{ $book->item_name }}</div>
                    </td>
                    <td class="table-text">
                        <div>¥{{ $book->item_amount }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $book->item_number }}冊</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $book->published }}</div>
                    </td>
                    <!-- 本: 更新ボタン -->
                    <td>
                        <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-edit"></i> 更新
                            </button>
                        </form>
                    </td>
                    <!-- 本: 削除ボタン -->
                    <td>
                        <form action="{{ url('books/'.$book->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">
                                <i class="glyphicon glyphicon-trash"></i> 削除
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection