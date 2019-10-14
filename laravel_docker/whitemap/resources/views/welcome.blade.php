@extends('layouts.app') 
@section('title') トップページ @endsection
@section('css')
<style>
main {
    padding-top: 5rem;
}
.starter-template {
    text-align: center;
}
</style>
@endsection
@section('content')
<main role="main" class="container">
    <div class="starter-template">
        <h1>異世界漂流 </h1>
        <h2>ドリフトサヴァイブ</h2>
        <p class="lead">
            空白の地図。君だけの旅路。
        </p>
    </div>
</main>
<!-- /.container -->
@endsection
@section('scripts')
<script src="{{ mix('js/welcome/index.js') }}"></script>
@endsection