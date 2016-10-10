 <h1 class="page-header"> Eventos  </h1>
 <div class="row">
     <div class="col-md-12">
         <p><a href="<?= site_url('admin/events/create')?>" class="btn btn-default">Cargar un nuevo evento <i class="glyphicon glyphicon-plus-sign"></i></a></p>
     </div>
     <div class="col-md-6">
         <div>
             {events}
             <div class="list-group-item">
                 <a href="<?= site_url('admin/events/view/')?>{id}">{title}</a>
                 <span class="pull-right">

                    <span class="label label-default"> <i ivass="glyphicon glyphicon-tag"></i> {date}</span>
                    <a href="<?= site_url('admin/events/remove/')?>{id}" class="label label-danger" data-confirm><i class="glyphicon glyphicon-trash"></i></a>
                    <a href="<?= site_url('admin/events/edit/')?>{id}" class="label label-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                </span>
             </div>
             {/events}
         </div>
     </div>
 </div>
