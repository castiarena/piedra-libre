<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h1 class="text-center">Crear usuario</h1>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <? if(strlen($errors) > 0){?>
                <div class="alert alert-danger"><?= $errors ?></div>
            <? } ?>

            <?= form_open('admin/create')?>
            <div class="col-md-6 clear-cols_left">
                <div class="form-group">
                    <?= form_input([ 'name' => 'name' , 'placeholder' => 'nombre', 'class' => 'form-control'])?>
                </div>
                <div class="form-group">
                    <?= form_input([ 'type' => 'email', 'name' => 'email' , 'placeholder' => 'email', 'class' => 'form-control'])?>
                </div>
            </div>
            <div class="col-md-6 clear-cols_right">
                <div class="form-group">
                    <?= form_password([ 'name' => 'password' , 'placeholder' => 'password', 'class' => 'form-control'])?>
                </div>
                <div class="form-group">
                    <?= form_password([ 'name' => 'repeat_password' , 'placeholder' => 'confirmar password', 'class' => 'form-control'])?>
                </div>
            </div>


            <div class="form-group">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <?= form_submit('Submit','Acceder',['class' => 'btn btn-warning'])?>
                    </div>
                    <div class="btn-group">
                        <?= form_reset('Submit','Borrar',['class' => 'btn btn-danger'])?>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-default" href="<?= site_url('admin')?>">Ya tengo usuario</a>
                    </div>
                </div>
            </div>
            <?= form_close()?>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>