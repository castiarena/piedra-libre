<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <meta property="og:url" content="<?= base_url(uri_string())?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $title?> " />
    <meta property="og:description" content="Creo que uno debe ir teniendo mucha confianza en la intuición que tiene. Uno llegó hasta aquí por la intuición y no por la certeza. El espíritu de Arenales es esa intuición que llega a ciegas acá. Que no se pierda ese espíritu. Que no se pierda esta cosa íntima de la noche, de la soledad, del frío, de la alegría. Porque cuando se pierde ese espíritu, yo entiendo que vamos a perder el mejor botín, el mejor tesoro que tiene Arenales. El de la intimidad donde todos nos sentimos iguales ante los demás. Y donde todos somos iguales." />
    <meta property="og:image" content="<?= site_url('assets/img/og-image.png')?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.min.css">
    <link rel="stylesheet" href="<?= site_url('assets/css/styles.css')?>">
    <link rel="stylesheet" href="<?= site_url('assets/css/font-awesome.css')?>">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab|Rubik|Lato:400,300,100,700,900' rel='stylesheet' type='text/css'>

</head>
<body>
<input type="hidden" data-root value="<?= site_url('')?>" name="data-root" id="data-root">
<header class="header">
    <a class="header-logo" href="<?= site_url('')?>"><img src="<?= site_url('assets/img/logo-white.svg')?>" alt="<?= $title?>"></a>
    <nav class="header-menu hidden-xs">
        <? foreach($navigation as $nav){?>
        <div class="header-menu__item">
            <a href="<?= $nav['url'] ?>" class="header-menu__link">
                <?= $nav['name']?>
                <? if( isset($nav['subnav'])){?> > <? } ?>
            </a>
            <? if( isset($nav['subnav'])){?>
                <div class="header-menu__sub-items">
                    <? foreach ($nav['subnav'] as $subnav) { ?>
                        <a href="<?= $subnav['url']?>" class="header-menu__sub-link"><?= $subnav['name']?></a><br>
                    <? }?>
                </div>
            <? } ?>
        </div>
        <? } ?>
    </nav>
</header>

<main>
    <?= $content?>
</main>

<footer class="footer">
    <div class="container">

        <div class="row">
            <div class="col-lg-4">
                <div class="col-lg-6">
                    <nav class="footer-nav">
                        <? foreach($navigation as $nav){?>
                        <div class="footer-nav__item">
                            <a href="<?= $nav['url'] ?>" class="footer-nav__link">
                                <?= $nav['name'] ?>
                            </a>
                        </div>
                        <? } ?>
                    </nav>
                </div>
                <div class="col-lg-6">
                    <nav class="footer-nav">
                        <div class="footer-nav__item">
                            <a href="https://www.facebook.com/fundacionpiedralibre/" target="_blank" class="footer-nav__link">
                                Facebook <i class="fa fa-facebook-square"></i>
                            </a>
                        </div>
                    </nav>
                </div>

            </div>
            <div class="col-lg-4">
                <img src="<?= site_url('assets/img/iso.svg')?>" alt="" width="300" class="center-block">
            </div>
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-btn">
                    <button class="btn " type="button">Newsletter</button>
                    </span>
                    <input type="text" class="form-control" placeholder="Tu email...">
                </div><!-- /input-group -->
                <br>
                <p><a href="mailto:fundacionarenales@gmail.com"> <i class="fa fa-envelope"></i>  fundacionarenales@gmail.com</a></p>
                <p> - Ruben Armando “Yagua” Rodríguez ( presidente ) - +54 011 67275997 o +54 2622 524895</p>
                <p> - Gerardo Castillo ( Tesorero ) - +54 261 5751781</p>
                <p> - Mora Rodriguez  - +54 011 49 403220</p>

            </div>


        </div>
        <div class="row footer-register">
            <div class="col-md-12">
                <h6 class="text-center">Piedra Libre - Fundación - Mendoza Arenales <i class="fa fa-copyright"></i> 2016</h6>
            </div>

        </div>
    </div>
</footer>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-101225092-1', 'auto');
    ga('send', 'pageview');

</script>
<script src="<?= site_url('assets/js/dep.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ar.min.js"></script>
<script src="<?= site_url('assets/js/site.js') ?>"></script>
</body>
</html>