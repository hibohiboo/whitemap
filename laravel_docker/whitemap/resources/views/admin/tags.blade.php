@extends('layouts.app')

@section('content')
    {{-- このコメントはレンダ後のHTMLには現れない --}}
    {{-- Bootstrapは一度に1つのモーダルウィンドウしかサポートしない。入れ子になったモーダルは、ユーザー経験が乏しいと思われるためサポートされていない。--}}
    {{-- 可能であれば、他の要素からの干渉を避けるために、モーダルHTMLを最上位に配置すること --}}
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
      <form id="edit-form" action="{{ url('tag')}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">編集</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>{{-- /.modal-header --}}
            <div class="modal-body">
              {{-- タグ名 --}}
              <div class="form-group">
                <label for="edit-tag-name" class="col-sm-3 control-label">タグ名</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="edit-tag-name" class="form-control" value="{{ old('tag') }}">
                </div>
              </div>
              {{-- タグ値 --}}
              <div class="form-group">
                <label for="edit-tag-value" class="col-sm-3 control-label">値</label>
                <div class="col-sm-6">
                    <input type="number" name="value" id="edit-tag-value" class="form-control" value="{{ old('tag') }}">
                </div>
              </div>
            </div>{{-- /.modal-body --}}
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
              <button type="submit" class="btn btn-primary">変更を保存</button>
            </div>{{-- /.modal-footer --}}
          </div>{{-- /.modal-content --}}
        </div>{{-- /.modal-dialog --}}
      </form>
    </div>{{-- /.modal --}}
    <main class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="card">
                <div class="card-header">新しいタグ</div>
                <div class="card-body">
                    {{-- バリデーションエラーの表示 --}}
                    @include('common.errors')

                    {{-- 新タグフォーム --}}
                    <form action="{{ url('tag')}}" method="POST" class="form-horizontal">
                        @csrf
                        {{-- タグ名 --}}
                        <div class="form-group">
                            <label for="tag-name" class="col-sm-3 control-label">タグ名</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="tag-name" class="form-control" value="{{ old('tag') }}">
                            </div>
                        </div>

                        {{-- タグ値 --}}
                        <div class="form-group">
                            <label for="tag-value" class="col-sm-3 control-label">値</label>

                            <div class="col-sm-6">
                                <input type="number" name="value" id="tag-value" class="form-control" value="{{ old('tag') }}">
                            </div>
                        </div>

                        {{-- タグ追加ボタン --}}
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
                    <div class="card-header">タグ一覧</div>
                    <div class="card-body">
                        <table class="table table-striped tag-table">
                            {{-- テーブルヘッダ --}}
                            <thead>
                                <tr>
                                    <th>タグ</th>
                                    <th>値</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            {{-- テーブル本体 --}}
                            <tbody>
                              @foreach ($tags as $tag)
                                <tr>
                                  <td class="table-text">
                                      <div>{{ $tag->name }}</div>
                                  </td>
                                  <td class="table-text">
                                      <div>{{ $tag->value }}</div>
                                  </td>
                                  <td>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#editModal" 
                                            data-action="{{ url('tag/' . $tag->id) }}" data-name="{{$tag->name}}" data-value="{{$tag->value}}"
                                    >
                                    <i class="fa fa-btn fa-edit"></i>
                                  </button>
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
@section('scripts')
  <script src="{{ mix('js/admin/tag/index.js') }}"></script>
@endsection