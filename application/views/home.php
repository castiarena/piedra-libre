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

<section id="noticias">
    <div class="container container-xl">
        <h1 class="text-center">Ultimas Noticias</h1>
        <? foreach($news as $news_list):?>
            <div class="news-box-col">
            <? foreach($news_list as $new):?>
                <div class="news-box">
                    <?php if($new->images):?>
                    <div class="news-box-img__container">
                        <img src="<?= site_url( $new->images )?>" alt="IMG">
                    </div>
                    <?php endif; ?>
                    <h2 class="news-box-title"><?= $new->title?></h2>
                    <p class="news-box-description"><?= substr($new->description ,0 ,200) ?>...</p>
                    <a href="<?= site_url( 'news/view/'.$new->id )?>" class="btn btn-ghost-one">Leer +</a>
                </div>
            <? endforeach;?>
            </div>
        <? endforeach;?>
    </div>
</section>

<section>
    <div class="banner banner-home-3 banner-seccion">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-right color-blanco">
                    <p>“Creo que uno debe ir teniendo mucha confianza en la intuición que tiene. Uno llegó hasta aquí por la intuición y no por la certeza. El espíritu de Arenales es esa intuición que llega a ciegas acá. Que no se pierda ese espíritu. Que no se pierda esta cosa íntima de la noche, de la soledad, del frío, de la alegría. Porque cuando se pierde ese espíritu, yo entiendo que vamos a perder el mejor botín, el mejor tesoro que tiene Arenales. El de la intimidad donde todos nos sentimos iguales ante los demás. Y donde todos somos iguales.”</p>
                    <h3>Yagua R</h3>
                </div>
            </div>
        </div>
    </div>
</section>