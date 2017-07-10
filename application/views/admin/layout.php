<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title> {title}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.min.css">
    <link rel="stylesheet" href="<?= site_url('assets/css/admin.css')?>">
    <link rel="apple-touch-icon" sizes="57x57" href="<?= site_url('/apple-icon-57x57.png')?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= site_url('/apple-icon-60x60.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= site_url('/apple-icon-72x72.png')?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= site_url('/apple-icon-76x76.png')?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= site_url('/apple-icon-114x114.png')?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= site_url('/apple-icon-120x120.png')?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= site_url('/apple-icon-144x144.png')?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= site_url('/apple-icon-152x152.png')?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= site_url('/apple-icon-180x180.png')?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= site_url('/android-icon-192x192.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= site_url('/favicon-32x32.png')?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= site_url('/favicon-96x96.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= site_url('/favicon-16x16.png')?>">
    <link rel="manifest" href="<?= site_url('/manifest.json')?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= site_url('/ms-icon-144x144.png')?>">
    <meta name="theme-color" content="#ffffff">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ar.min.js"></script>
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