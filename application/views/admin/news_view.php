<div class="row">
    {new_view}

    <div class="col-md-12">
         <h2 class="page-header">
             {title}
             <small>
                <a href="<?= site_url('admin/news/remove/')?>{id}" class="label label-danger" data-confirm><i class="glyphicon glyphicon-trash"></i></a>
                <a href="<?= site_url('admin/news/edit/')?>{id}" class="label label-warning"><i class="glyphicon glyphicon-pencil"></i></a>
             </small>
         </h2>

    </div>
    <div class="col-md-6">
        <h3>
            Fecha: <span class="label label-success">{date}</span>
            Tag: <span class="label label-default">{tags}</span>
        </h3>
        <hr>
        {description}
    </div>
    <?php if($new_view[0]['images'] !== site_url('')):?>
        <div class="col-md-6">
            <img src="{images}" alt="{title}" class="thumbnail">
        </div>
    <?php endif;?>
    {/new_view}


</div>
 <hr>

