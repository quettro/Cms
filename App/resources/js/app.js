/**
 *
 */
import "./bootstrap";

/**
 *
 */
if (window.$('meta[name="csrf-token"]').length) {
    let params = {};
        params.headers = {};
        params.headers['X-CSRF-TOKEN'] = window.$('meta[name="csrf-token"]').attr('content');

    window.$.ajaxSetup(params);
}

/**
 *
 */
window.$('pre code').each(function () {
    window.Highlight.highlightElement(this);
});

/**
 *
 */
window.$('.codeMirror-textarea').each(function () {
    let params = {};
        params.mode = 'php';
        params.theme = 'material-darker';
        params.lineNumbers = true;
        params.indentUnit = 4;
        params.indentWithTabs = true;
        params.autoCloseBrackets = true;
        params.autoCloseTags = true;
        params.readOnly = this.disabled ? 'nocursor' : false;

    window.$(this).data('CodeMirror', window.CodeMirror.fromTextArea(this, params));
});

window.$('.codeMirror-nav__fullscreen').click(function (event) {
    event.preventDefault();

    let textarea = window.$(this).parents('.codeMirror').find('.codeMirror-textarea');
    let textarea__codemirror = textarea.data('CodeMirror');

    textarea__codemirror.setOption('fullScreen', !textarea__codemirror.getOption('fullScreen'));
});

/**
 *
 */
if(window.$('.check-all-the-boxes').length) {
    window.$('input[type="checkbox"][id^=check-all-the-boxes--]').change(function() {
        window.$(this).parents('.check-all-the-boxes').eq(0).find('input[type="checkbox"]').prop('checked', this.checked);
    });

    window.$('.check-all-the-boxes').each(function() {
        let _d = window.$(this).find('input[type="checkbox"]').not('[id^=check-all-the-boxes--]').length;
        let _c = window.$(this).find('input[type="checkbox"]:checked').not('[id^=check-all-the-boxes--]').length;

        window.$(this).find('input[type="checkbox"][id^=check-all-the-boxes--]').prop('checked', _d === _c);

        window.$(this).find('input[type="checkbox"]').not('[id^=check-all-the-boxes--]').change(() => {
            let _d = window.$(this).find('input[type="checkbox"]').not('[id^=check-all-the-boxes--]').length;
            let _c = window.$(this).find('input[type="checkbox"]:checked').not('[id^=check-all-the-boxes--]').length;

            window.$(this).find('input[type="checkbox"][id^=check-all-the-boxes--]').prop('checked', _d === _c);
        });
    });
}

/**
 *
 */
window.$('[data-toggle="sortable"][data-type="ol"]').each(function () {
    let params = {};
        params.handle = '[data-toggle="sortable-handle"]';
        params.draggable = 'li';
        params.animation = 150;

        params.onUpdate = (event) => {
            let order = [];

            window.$(this).find('> li[data-id]').each(function(index, tr) {
                order.push({id: Number(window.$(this).data('id')), index});
            });

            window.$.post(window.$(this).data('save-to'), { order });
        };

    new window.Sortable(this, params);
});

window.$('[data-toggle="sortable"][data-type="table"]').each(function () {
    let params = {};
        params.handle = '[data-toggle="sortable-handle"]';
        params.draggable = 'tr';
        params.animation = 150;

        params.onUpdate = (event) => {
            let order = [];
            let tbody = window.$(event.target);

            tbody.find('tr[data-id]').each(function(index, tr) {
                order.push({id: Number(window.$(tr).data('id')), index});
            });

            window.$.post(window.$(this).data('save-to'), { order });
        };

    new window.Sortable(window.$(this).find('tbody')[0], params);
});

/**
 *
 */
window.$('.js--form-delete').submit(function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Подтверждение',
        text: 'Вы действительно хотите удалить данную запись?',
        icon: 'question',
        iconColor: '#ef4444',
        focusConfirm: false,
        returnFocus: false,
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'Удалить',
        cancelButtonColor: '#9ca3af',
        cancelButtonText: 'Закрыть'
    }).then(
        (result) => {
            if(result.isConfirmed) {
                window.$(this).unbind('submit').submit();
            }
        }
    );
});

/**
 *
 */
window.$('input[type="checkbox"][id^=w-tree--checked-]').change(function() {
    let w_tree__item = window.$(this).parents('.w-tree__item').eq(0);
    let w_tree__item__checkboxes = w_tree__item.find('.w-tree input[type="checkbox"][id^=w-tree--checked-]');

    if(!this.checked) {
        w_tree__item__checkboxes.prop('checked', this.checked);
    } else {
        if(w_tree__item__checkboxes.length) {
            if(confirm(`Отметить все (${w_tree__item__checkboxes.length}) дочерние веб-страницы?`)) {
                w_tree__item__checkboxes.prop('checked', this.checked);
            }
        }
    }
});

window.$('.btn-open-or-hide-the-w-tree').click(function(event) {
    event.preventDefault();

    let w_tree__item = window.$(this).parents('.w-tree__item').eq(0);
    let w_tree = w_tree__item.find('.w-tree').eq(0);

    if(window.$(this).attr('data-is-active').toLowerCase() !== 'true') {
        window.$(this).attr('data-is-active', 'true');

        if(w_tree.length) {
            w_tree.removeClass('d-none');
        }
    } else {
        window.$(this).attr('data-is-active', 'false');

        if(w_tree.length) {
            w_tree.addClass('d-none');
        }
    }
});

/**
 *
 */
if(window.$('meta[name^=toasts]').length) {
    [
        {
            $: window.$('meta[name="toasts[error]"]'),

            params: {
                icon: 'error',
                title: 'Произошла ошибка',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 15000,
                timerProgressBar: true,
            }
        },
        {
            $: window.$('meta[name="toasts[success]"]'),

            params: {
                icon: 'success',
                title: 'Информация',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 15000,
                timerProgressBar: true,
            }
        },
    ].forEach(
        function (toast, index) {
            toast.$.each(
                function () {
                    let params = toast.params;
                        params.text = window.$(this).attr('content');

                    window.Swal.fire(params).then();
                }
            );
        }
    );
}
