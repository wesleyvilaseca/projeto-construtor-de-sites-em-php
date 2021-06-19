modules = {};
modules.methods = {
    modalimg: function (src) {
        $('#modal_image_module').modal('show');
        document.getElementById('module_imagem_example').innerHTML = '';
        $("#module_imagem_example").append(`<img src="${src}" width="100%" />`);
    }
};