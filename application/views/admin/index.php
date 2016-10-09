<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="logo-admin">
                <img src="<?= site_url('assets/img/iso.svg') ?>" class="center-block" alt="Logo">
            </div>
            <h1 class="text-center">Acceder</h1>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <? if(isset($errors['user'])){?>
                <div class=" text-danger"> <small><?=$errors['user']?></small></div>
            <? } ?>
            <?= form_open('admin')?>
            <div class="form-group">
                <?= form_input([
                    'value' => $email,
                    'name' => 'email' ,
                    'placeholder' => 'email',
                    'class' => 'form-control'
                ])?>
                <? if(isset($errors['email'])){?>
                    <p class="text-danger"> <small><?=$errors['email']?></small></p>
                <? } ?>
            </div>
            <div class="form-group">
                <?= form_password([
                    'name' => 'password' ,
                    'placeholder' => 'password',
                    'class' => 'form-control'])?>
                <? if(isset($errors['password'])){?>
                    <p class="text-danger"> <small><?=$errors['password']?></small></p>
                <? } ?>
            </div>
            <div class="form-group">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <?= form_submit('Submit','Acceder',['class' => 'btn btn-warning'])?>
                    </div>
                    <div class="btn-group">
                        <?= form_reset('Submit','Borrar',['class' => 'btn btn-danger'])?>
                    </div>
                </div>
            </div>
            <div class="form-group">
            </div>
            <?= form_close()?>
        </div>
        <div class="col-md-4"></div>

    </div>
</div>

