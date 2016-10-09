<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
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
                            <a href="facebook.com" class="footer-nav__link">
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
                <h6 class="text-center">Piedra Libre - Fundación - Mendonza Arenales <i class="fa fa-copyright"></i> 2016</h6>
            </div>

        </div>
    </div>
</footer>
<script src="<?= site_url('assets/js/site.js') ?>"></script>
</body>
</html>