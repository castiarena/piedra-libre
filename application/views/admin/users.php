<h1 class="page-header">Usuarios</h1>
<div class="row">
    <div class="col-md-6">

        <div>
            {users}
            <div class="list-group-item bg-success">
                {name}
                    <span class="pull-right">
                    <a href="<?= site_url('admin/users/remove/')?>{id}" class="label label-danger"><i class="glyphicon glyphicon-trash"></i></a>
                    <a href="<?= site_url('admin/users/edit/')?>{id}" class="label label-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                    <span class="label label-default"> <i ivass="glyphicon glyphicon-tag"></i> {usage}</span>
                    </span>
            </div>
            {/users}
        </div>
    </div>
</div>