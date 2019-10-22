import { ModalEventHandler } from 'bootstrap';
$('#editModal').on('show.bs.modal', function(event: ModalEventHandler<HTMLElement>) {
    const target = event.relatedTarget;
    console.log('modal', target);
    if (target === undefined) {
        return;
    }
    const $button = $(target); // モーダル切替えボタン
    const action = $button.data('action'); // data-* 属性から情報を抽出
    const name = $button.data('name');
    const value = $button.data('value');

    // モーダルの内容を更新。ここではjQueryを使用するが、代わりにデータ・バインディング・ライブラリまたは他のメソッドを使用することも可能
    const $modal = $(this);
    $modal.find('#edit-tag-name').val(name);
    $modal.find('#edit-tag-value').val(value);
    $modal.find('#edit-form').attr('action', action);
});
