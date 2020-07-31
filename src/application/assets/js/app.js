import "../sass/app.scss";
window.jQuery = window.$ = require('jquery');
require('bootstrap');
require('admin-lte/plugins/jQueryUI/jquery-ui');
require('admin-lte/dist/js/adminlte');


$(document).ready( () => {
    $('.btn-tree').click( function () {
        $(this).find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
    })
    $('.add-category').click( function() {
        $('#modalAddCategory').find('input[name="parent_id"]').val($(this).data('parent-id'));
    })
    $('.edit-category').click( function () {
        let parent = $('#modalEditCategory');
        parent.find('select[name="parent_id"]').val($(this).data('parent-id'))
        parent.find('input[name="id"]').val($(this).data('id'))
        parent.find('input[name="category_name"]').val($(this).data('name'))
        parent.find('input[name="category_desc"]').val($(this).data('desc'));
    });
})

