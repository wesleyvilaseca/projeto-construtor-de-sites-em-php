departaments = {};
departaments.methods = {
    seo: function (val) {
        let seo = val;
        if (seo) {
            seo = global.string_to_slug(seo);
            $("#seo").val(seo);
        }
    }
};