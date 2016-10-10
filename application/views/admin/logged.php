<h1 class="page-header">Bienvenido!</h1>
<div class="row">
    <div class="col-md-4">
        <p>Información cargada</p>
        <div class="list-group">
            <a href="<?= site_url('admin/news')?>" class="list-group-item">
                Noticias
                <span class="badge"><?= $newsCount?></span>
            </a>
            <a href="<?= site_url('admin/events')?>" class="list-group-item">
                Eventos
                <span class="badge"><?= $eventsCount?></span>
            </a>
            <a href="<?= site_url('admin/tags')?>" class="list-group-item">
                Tags
                <span class="badge"><?= $tagsCount?></span>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <p>Usuarios creados</p>
        <div class="list-group">
            <a href="<?= site_url('admin/users?type=admin')?>" class="list-group-item">
                Administradores
                <span class="badge">14</span>
            </a>
            <a href="<?= site_url('admin/news')?>" class="list-group-item">
                Miembros
                <span class="badge">14</span>
            </a>
        </div>
    </div>
</div>
<hr>





