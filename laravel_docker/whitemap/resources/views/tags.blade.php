@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="card">
                <div class="card-header">
                    新しいタグ
                </div>

                <div class="card-body">
                    <!-- バリデーションエラーの表示 -->
                    @include('common.errors')

                    <!-- 新タグフォーム -->
                    <form action="{{ url('tag')}}" method="POST" class="form-horizontal">
                        @csrf

                        <!-- タグ名 -->
                        <div class="form-group">
                            <label for="tag-name" class="col-sm-3 control-label">タグ</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="tag-name" class="form-control" value="{{ old('tag') }}">
                            </div>
                        </div>

                        <!-- タグ追加ボタン -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> タグ追加
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TODO: 現在のタグ -->
        </div>
    </div>
@endsection