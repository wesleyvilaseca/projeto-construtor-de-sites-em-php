<?php

namespace app\classes\supports\supports_libsjs;

trait LibsJs
{

    public  function datatableJquery()
    {
        $js = '<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" type="text/javascript"></script>';
        return $js;
    }

    public function datatableResponsiveJs()
    {
        $js = '<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js" type="text/javascript"></script>';
        return $js;
    }

    public function selec2()
    {
        $js = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">';
        $js .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js" type="text/javascript"></script>';
        $js .= '<script src="' . URL_BASE . 'assets/principal-cadastro-login/js/plugins/select2_pt.js" type="text/javascript"></script>';
        return $js;
    }

    public function bootstrapjs()
    {
        $js = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>';
        return $js;
    }

    public function ui()
    {
        $js = '<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>';
        $js .= '<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet"/>';
        return $js;
    }

    public function maskmoney()
    {
        $js = '<script src="' . URL_BASE . 'assets/adm/js/plugins/maskMoney/jquery.maskMoney.min.js" type="text/javascript"></script>';
        return $js;
    }

    public function mask()
    {
        $js = '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>';
        return $js;
    }

    public function jquery()
    {
        $js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>';
        return $js;
    }

    public function popover()
    {
        $js = '<script src="' . URL_BASE . 'assets/adm/js/plugins/popper/popper.min.js" type="text/javascript"></script>';
        return $js;
    }

    public function tinymce()
    {
        //$js = '<script src="https://cdn.tiny.cloud/1/' . keytiny . '/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>';
        //$js .= '<script src="' . URL_BASE . 'assets/adm/js/plugins/tinymce/langs/pt_BR.js"></script>';
        $js = '<script src="https://cdn.tiny.cloud/1/pno1jzy3fokxrq842muonq3jfelg0kv5blqeryq4qxob95al/tinymce/5.8.0-111/tinymce.min.js" referrerpolicy="origin"></script>';
        return $js;
    }

    public function recaptcha()
    {
        $js = '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
        return $js;
    }

    public function dataTableActive($idtable)
    {
        return '<script>
                $(document).ready(function() {
                $("#' . $idtable . '").DataTable({
                    "language": { "url": "' . URL_BASE . 'assets/adm/js/plugins/table/ptbr.json" }    
                });
                });
            </script>';
    }

    public function fancybox_js(){
        $js = '<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha256-yt2kYMy0w8AbtF89WXb2P1rfjcP/HTHLT7097U8Y5b8=" crossorigin="anonymous"></script>';
        $js .= '<script>';
        $js .= '$(".filemaneger").fancybox({
            "width": 500,
            "height": 500,
            "type": "iframe",
            "autoScale": false,
            "autoSize": false,
            "autoDimensions": false,
            "iframe": {
                "css": {
                    "height": "100%"
                }
            }
        });';


        $js .= "function responsive_filemanager_callback(field_id){
            $('.' + field_id).attr('src', '". FILEMANAGER['UPLOAD_DIR'] ."' + $('#' + field_id).val());
        }";

        $js.= '</script>';
        return $js;
    }

    public function tinyEditorActive()
    {
        $rootcss = json_decode(getSession('theme'))->root_css_file;
        $css =  $rootcss ? URL_BASE . $rootcss : URL_BASE . 'assets/adm/css/all.css';
        $editor = $this->tinymce();
        $editor .= '<script>';
        $editor.= 'tinymce.init({
                    language: "pt_BR",
                    content_css : "' . $css .'",
                    language_url: "' . URL_BASE . 'assets/adm/vendor/tinymce/langs/pt_BR.js",
                    relative_urls: false,
                    remove_script_host: false,
                    selector: ".editor",
                    height: 300,
                    plugins: [/*bbcode*/ "code print preview importcss tinydrive searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap emoticons responsivefilemanager"],
                    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect| template",
                    toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview | code",
                    /*bbcode_dialect: "punbb",*/
                    image_advtab: false,
                    external_filemanager_path: "'. FILEMANAGER['EXTERNAL_FILEMAGER_PATH'] .'",
                    filemanager_title: "Responsive Filemanager",
                    external_plugins: {
                        "responsivefilemanager": "'. FILEMANAGER['PLUGIN_TINY_FILEMANAGER'] . '",
                        "filemanager": "'. FILEMANAGER['PLUGIN_FILEMANAGER'] .'"
                    },
                    templates: "'. FILEMANAGER['TEMPLATES'] .'",
                    branding: false,
                    mobile: { menubar: true },
                    toolbar_mode: "floating",
                })';
        $editor .= '</script>';
        return $editor;
    }

    public function carousel_js() {
        $js = '<script src="'. URL_BASE . 'assets/global/js/plugins/owlcarorel.js/owl.carousel.js" type="text/javascript"></script>';
        return $js;
    }

    public function carousel_min_js() {
        $js = '<script src="'. URL_BASE . 'assets/global/js/plugins/owlcarorel.js/owl.carousel.min.js" type="text/javascript"></script>';
        return $js;
    }

    public function isotope(){
        $js = '<script src="' . URL_BASE . 'assets/institucional/js/isotope.pkgd.min.js"></script>';
        return $js;
    }

    public function magnificPopUp() {
        $js = '<script src="' . URL_BASE . 'assets/institucional/js/magnify/jquery.magnific-popup.min.js"></script>';
        return $js;
    }
}
