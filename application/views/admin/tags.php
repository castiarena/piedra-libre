<h1>Tags</h1>
<hr>
<? if($editing):?>
    <h4>Editando el tag: <strong>{tag_name}</strong></h4>
<? endif;?>
<div class="row">
    <div class="col-md-6">
        <div>
            <form action="{action_url}" method="post">
                <div class="input-group">
                    <span class="input-group-addon"> <i class="glyphicon glyphicon-tag"></i></span>
                    <input type="hidden" name="id" id="id" value="{tag_id}">
                    <input type="text" name="name" placeholder="Tag" class="form-control" id="name" value="{tag_name}">
                    <span class="input-group-btn">
                        <? if(!$editing){?>
                            <button class="btn btn-default" type="submit">Crear tag</button>
                        <? }else{?>
                            <button class="btn btn-warning" type="submit">Editar</button>
                        <? }?>

                    </span>
                </div>
            </form>
        </div>
        <br>
        <div>
            {tags}
            <div class="list-group-item bg-success">
                {name}
                    <span class="pull-right">
                    <a href="<?= site_url('admin/tags/remove/')?>{id}" class="label label-danger"><i class="glyphicon glyphicon-trash"></i></a>
                    <a href="<?= site_url('admin/tags/edit/')?>{id}" class="label label-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                    <span class="label label-default"> <i ivass="glyphicon glyphicon-tag"></i> {usage}</span>
                    </span>
            </div>
            {/tags}
        </div>
    </div>
</div>
<hr>