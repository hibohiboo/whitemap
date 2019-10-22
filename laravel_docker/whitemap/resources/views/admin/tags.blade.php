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
                            <label for="tag-name" class="col-sm-3 control-label">タグ名</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="tag-name" class="form-control" value="{{ old('tag') }}">
                            </div>
                        </div>

                        <!-- タグ名 -->
                        <div class="form-group">
                            <label for="tag-value" class="col-sm-3 control-label">値</label>

                            <div class="col-sm-6">
                                <input type="number" name="value" id="tag-value" class="form-control" value="{{ old('tag') }}">
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

            @if (count($tags) > 0)
                <div class="card">
                    <div class="card-header">
                        タグ一覧
                    </div>
                    <div class="card-body">
                        <table class="table table-striped tag-table">
                            <!-- テーブルヘッダ -->
                            <thead>
                                <tr>
                                    <th>タグ</th>
                                    <th>値</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <!-- テーブル本体 -->
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $tag->name }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $tag->value }}</div>
                                        </td>
                                        <!-- TODO: 削除ボタン -->
                                        <td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            {{ $tags->links() }}
        </div>
    </div>
@endsection