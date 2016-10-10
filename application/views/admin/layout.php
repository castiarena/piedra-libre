<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title> {title}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= site_url('assets/css/admin.css')?>">
</head>
<body>
<? if(isset($user)){ ?>
    <div class="lateral-bar">
        <div class="lateral-bar_content">
            <div class="logo-admin">
                <img src="<?= site_url('assets/img/iso.svg') ?>" alt="Logo">
            </div>
            <div class="list-group">
                {navigation}
                <a href="{url}" class="list-group-item {active}">{name}</a>
                {/navigation}
            </div>
        </div>
    </div>
    <nav class="admin-status-top">
        <div class="text-right">
            <div class="admin-status-top__item">
                <i class="glyphicon glyphicon-user"></i> <?= $user['name']?>
            </div>
            <div class="admin-status-top__item">
                <a href="<?= site_url('admin/logout')?>">log out</a>
            </div>
        </div>
    </nav>
<? }?>
<main <? if(isset($user)){ ?> class="content-logged" <? }?>>
    <?= $content ?>
</main>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 'auto',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor colorpicker',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'forecolor backcolor | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: '//www.tinymce.com/css/codepen.min.css'
    });


    (function(win, doc){
        'use strict';
        var confirmLinks = doc.querySelectorAll('[data-confirm]');

        for(var i = 0; i < confirmLinks.length; i++){
            confirmLinks[i].addEventListener('click',function(event){

                if(!confirm('Estas seguro que desea eliminar esta noticia?, no vas a poder recuperarla')){
                    event.preventDefault();
                }
            });
        }
    })(window,document)
</script>
</body>
</html>