@extends('layouts.app')
@section('title') クーポン管理 @endsection
@section('admin')
  <li class="nav-item"><a class="nav-link" href="{{ url('/admin') }}">管理者ダッシュボード</span></a></li>
@endsection

@section('content')
    {{-- このコメントはレンダ後のHTMLには現れない --}}
    {{-- Bootstrapは一度に1つのモーダルウィンドウしかサポートしない。入れ子になったモーダルは、ユーザー経験が乏しいと思われるためサポートされていない。--}}
    {{-- 可能であれば、他の要素からの干渉を避けるために、モーダルHTMLを最上位に配置すること --}}
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
      <form id="edit-form" action="{{ url('coupon')}}" method="POST">
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
              {{-- クーポン名 --}}
              <div class="form-group">
                <label for="edit-coupon-name" class="col-sm-3 control-label">クーポン名</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="edit-coupon-name" class="form-control" value="{{ old('coupon') }}">
                </div>
              </div>
              {{-- クーポン値 --}}
              <div class="form-group">
                <label for="edit-coupon-point" class="col-sm-3 control-label">値</label>
                <div class="col-sm-6">
                    <input type="number" name="point" id="edit-coupon-point" class="form-control" value="{{ old('coupon') }}">
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
                <div class="card-header">新しいクーポン</div>
                <div class="card-body">
                    {{-- バリデーションエラーの表示 --}}
                    @include('common.errors')

                    {{-- 新クーポンフォーム --}}
                    <form id="create-form" action="{{ url('coupon')}}" method="POST" class="form-horizontal">
                        @csrf
                        {{-- クーポンID --}}
                        <div class="form-group">
                            <label for="coupon-id" class="col-sm-3 control-label" >クーポンID</label>

                            <div class="col-sm-6">
                                <input type="text" name="id" id="coupon-id" class="form-control" value="{{ old('coupon') }}">
                            </div>
                        </div>

                        {{-- クーポン名 --}}
                        <div class="form-group">
                            <label for="coupon-name" class="col-sm-3 control-label">クーポン名</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="coupon-name" class="form-control" value="{{ old('coupon') }}">
                            </div>
                        </div>
                        {{-- クーポン種別 --}}
                        <div class="form-group">
                            <label for="coupon-type" class="col-sm-3 control-label">クーポン種別</label>

                            <div class="col-sm-6">
                                 {{Form::select('type', $types, old('coupon')) }}
                            </div>
                        </div>
                        {{-- クーポン値 --}}
                        <div class="form-group">
                            <label for="coupon-point" class="col-sm-3 control-label">値</label>

                            <div class="col-sm-6">
                                <input type="number" name="point" id="coupon-point" class="form-control" value="{{ old('coupon') }}">
                            </div>
                        </div>

                        {{-- クーポン追加ボタン --}}
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> クーポン追加
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (count($coupons) > 0)
                <div class="card">
                    <div class="card-header">クーポン一覧</div>
                    <div class="card-body">
                        <table class="table table-striped coupon-table">
                            {{-- テーブルヘッダ --}}
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>クーポン</th>
                                    <th>値</th>
                                    <th>種別</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            {{-- テーブル本体 --}}
                            <tbody>
                              @foreach ($coupons as $coupon)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $coupon->id }}</div>
                                    </td>
                                  <td class="table-text">
                                      <div>{{ $coupon->name }}</div>
                                  </td>
                                  <td class="table-text">
                                      <div>{{ $coupon->point }}</div>
                                  </td>
                                  <td class="table-text">
                                      <div>{{ $types[$coupon->type]  }}</div>
                                  </td>
                                  <td>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#editModal" 
                                            data-action="{{ url('coupon/' . $coupon->id) }}" data-name="{{$coupon->name}}" data-value="{{$coupon->point}}"
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
            {{ $coupons->links() }}
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/localization/messages_ja.js"></script>
<script src="{{ mix('js/admin/coupon/index.js') }}"></script>
@endsection