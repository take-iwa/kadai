@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('common.errors')
        <form action="{{ url('books/update') }}" method="POST">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <label for="item_name" class="control-label">本タイトル</label>
                    <input type="text" id="item_name" name="item_name" class="form-control" value="{{$book->item_name}}">
                </div>
            </div>
            <!--/ item_name -->
            <!-- item_number -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <label for="item_number" class="control-label">冊数</label>
                    <input type="text" id="item_number" name="item_number" class="form-control" value="{{$book->item_number}}">
                </div>
            </div>
            <!--/ item_number -->
            <!-- item_amount -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <label for="item_amount" class="control-label">値段</label>
                    <input type="text" id="item_amount" name="item_amount" class="form-control" value="{{$book->item_amount}}">
                </div>
            </div>
            <!--/ item_amount -->
            <!-- published -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <label for="published" class="control-label">公開日</label>
                    <input type="datetime" id="published" name="published" class="form-control" value="{{$book->published}}"/>
                </div>
            </div>
            <!--/ published -->
            <!-- Save ボタン/Back ボタン -->
            <div class="col-sm-offset-3 col-sm-6">
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ url('/') }}">
                        <i class="glyphicon glyphicon-backward"></i> Back
                    </a>
                </div>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$book->id}}" />
            <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>
@endsection