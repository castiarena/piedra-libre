<section>
    <div class="banner banner-static banner-seccion__new-view">
        <div class="container text-center">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="header-title font-title text-uppercase"><strong><?= $new->title?></strong></h2>
                <br><br>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container container-xl">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header"><?= $new->title?>  <span class="h4 pull-right"><?= $new->date?></span></h2>
                <h4><?= $new->tags?></h4>
            </div>
            <div class="col-md-6">
                <?= $new->description?>
            </div>
            <? if( $new->images != '' && isset($new->images)): ?>
            <div class="col-md-6">
                <img src="<?= site_url($new->images) ?>" class="img-responsive img-thumbnail" alt="<?= $new->title?>">
            </div>
            <? endif;?>
        </div>
    </div>
</section>