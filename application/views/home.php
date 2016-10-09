<!-- Fundacion piedra libre - portfolio web-->

<section>
    <div class="banner banner-static">
        <div class="container text-center">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="header-title font-title text-uppercase">Fundación -  <strong>Piedra Libre</strong></h2>
                <h4 class="color-blanco font-l">Libre acceso al <i>"Cajón de los Arenales".</i></h4>
                <br>
                <a href="#" class="btn btn-ghost-two">Conocé mas</a>
                <br>
            </div>
        </div>
        <a href="#" class="color-blanco font-xl banner-scroll"></a>
    </div>

</section>

<section id="servicios">
    <div class="container container-xl">
        <h1 class="text-center">Ultimas Noticias</h1>
        <? foreach($news as $news_list):?>
            <div class="news-box-col">
            <? foreach($news_list as $new):?>
                <div class="news-box">
                    <div class="news-box-img__container">
                        <img src="<?= site_url('assets/img/banner-home-1.jpg')?>" alt="IMG">
                    </div>
                    <h2 class="news-box-title"><?= $new->title?></h2>
                    <p><?= $new->description?></p>
                </div>
            <? endforeach;?>
            </div>
        <? endforeach;?>
    </div>
</section>


<section id="portfolio">
    <div class="container container-xl">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">portfolio</h1>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium alias, animi architecto consectetur debitis esse qui ratione sequi suscipit? Dolorum facere harum iure voluptas voluptatibus. Est molestiae numquam sunt!</p>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

<section id="creativos">
    <div class="container container-xl">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">creativos</h1>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium alias, animi architecto consectetur debitis esse qui ratione sequi suscipit? Dolorum facere harum iure voluptas voluptatibus. Est molestiae numquam sunt!</p>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

<section id="clientes">
    <div class="container container-xl">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">clientes</h1>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium alias, animi architecto consectetur debitis esse qui ratione sequi suscipit? Dolorum facere harum iure voluptas voluptatibus. Est molestiae numquam sunt!</p>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>

<section id="contacto">
    <div class="container container-xl">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">contacto</h1>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium alias, animi architecto consectetur debitis esse qui ratione sequi suscipit? Dolorum facere harum iure voluptas voluptatibus. Est molestiae numquam sunt!</p>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>