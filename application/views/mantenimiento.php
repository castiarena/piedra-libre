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
                <a href="<?= $nav['url'] ?>" class="header-menu__link" <?= preg_match('/^http/', $nav['url']) ? 'target="_blank"' : '' ?>>
                    <?= $nav['name']?>
                </a>
            </div>
        <? } ?>
    </nav>
</header>

<main>
    <section>
        <div class="banner banner-static ">
            <div class="container ">
                <div class="col-md-6 col-md-offset-3">
                    <img src="<?= site_url('assets/img/iso.svg')?>" width="220px" alt="Piedra Libre" class="center-block">
                    <h2 class="header-title font-title text-uppercase text-center">En construcción</h2>
                    <br>
                    <h3 class="font-title text-uppercase text-center color-blanco">Información de contacto:</h3>

                    <div class="box text-left">
                        <p><a href="mailto:fundacionarenales@gmail.com"> <i class="fa fa-envelope"></i>  fundacionarenales@gmail.com</a></p>
                        <p> <i class="fa fa-user"></i> Ruben Armando “Yagua” Rodríguez ( presidente ) - +54 011 67275997 o +54 2622 524895</p>
                        <p> <i class="fa fa-user"></i>  Gerardo Castillo ( Tesorero ) - +54 261 5751781</p>
                        <p> <i class="fa fa-user"></i>  Mora Rodriguez  - +54 011 49 403220</p>
                    </div>

                </div>
            </div>

        </div>
    </section>

</main>

</body>
</html>