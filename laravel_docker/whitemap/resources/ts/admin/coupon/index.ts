import { ModalEventHandler } from 'bootstrap';
// 拡張しているjQUeryの呼び出し
// import * as JQuery from 'jquery';
// require('../../types/index.d.ts');

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
$.validator.setDefaults({
    debug: false, // trueの場合、デバッグモードになりフォームは送信されない
    onkeyup: false, // 有効の場合はkeyupの度にremoteが走ってしまうため。。
    success: null,
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
$('#create-form').validate({
    rules: {
        id: {
            required: true,
            remote: '/api/coupon/unique', // remoteを使うにはslimではダメ
            pattern: '[a-zA-Z0-9_-]+' // patternを使うにはadditonalの読み込みが必要
            // remote: {
            //   url: "check-email.php",
            //   type: "get",
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

// var forms = document.getElementsByClassName('needs-validation');
// // Loop over them and prevent submission
// var validation = Array.prototype.filter.call(forms, function(form) {
//     form.addEventListener(
//         'submit',
//         function(event: any) {
//             console.log(event);
//             if (form.checkValidity() === false) {
//                 event.preventDefault();
//                 event.stopPropagation();
//             }
//             form.classList.add('was-validated');
//         },
//         false
//     );
// });
