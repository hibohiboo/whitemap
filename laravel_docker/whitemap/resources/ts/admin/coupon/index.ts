import { ModalEventHandler } from 'bootstrap';
// 拡張しているjQUeryの呼び出し
// import * as JQuery from 'jquery';
// require('../../types/index.d.ts');

// 新規作成
$.validator.setDefaults({
    debug: false, // trueの場合、デバッグモードになりフォームは送信されない
    onkeyup: false, // 有効の場合はkeyupの度にremoteが走ってしまうため。。
    success: null,
    validClass: 'valid-feedback',
    errorClass: 'invalid-feedback',
    errorElement: 'span',
    errorPlacement: function(error: JQuery, element: JQuery) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function(element: HTMLElement, errorClass: string, validClass: string) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function(element: HTMLElement, errorClass: string, validClass: string) {
        $(element).removeClass('is-invalid');
    }
});
$('#create-form')
    .submit(event => {
        // bootstrap4のカスタムバリデーション
        const form = event.target as HTMLFormElement;
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    })
    .validate({
        rules: {
            id: {
                required: true,
                remote: '/api/coupon/unique', // remoteを使うにはslimではダメ
                pattern: '[a-zA-Z0-9_-]+' // patternを使うにはadditonalの読み込みが必要
                // remote: {
                //   url: "check-email.php",
                //   type: "post",
                //   data: {
                //     username: function() {
                //       return $( "#username" ).val();
                //     }
                //   }
                // }
            },
            name: { required: true },
            point: { required: true, number: true }
        },
        messages: {
            id: {
                remote: '既に使われているＩＤです',
                pattern: '半角英数字と-_を使用できます'
            }
        }
        // submitHandler: function(form: HTMLFormElement) {
        //     // some other code
        //     // maybe disabling submit button
        //     // then:
        //     console.log(form);
        //     // $(form).submit();
        // }
    });

// 編集
$('#editModal').on('show.bs.modal', function(event: ModalEventHandler<HTMLElement>) {
    const target = event.relatedTarget;
    if (target === undefined) {
        return;
    }
    const $button = $(target); // モーダル切替えボタン
    const action = $button.data('action'); // data-* 属性から情報を抽出
    const name = $button.data('name');
    const point = $button.data('point');
    const type = $button.data('type');
    const is_display = $button.data('is_display') === 1;

    // モーダルの内容を更新
    const $modal = $(this);
    $modal.find('#edit-coupon-name').val(name);
    $modal.find('#edit-coupon-type').val(type);
    $modal.find('#edit-coupon-point').val(point);
    $modal.find('#edit-coupon-is_display').prop('checked', is_display);
    $modal.find('#edit-form').attr('action', action);
});
// HTML5標準のエラーメッセージのカスタマイズ
$('#edit-coupon-name').on('invalid', e => {
    const nameInput = e.target as HTMLInputElement;
    if (nameInput.value === '') {
        nameInput.setCustomValidity('名前を入力してください。');
    }
});
