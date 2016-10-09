 <h1> Noticias <a href="<?= site_url('admin/news/create')?>"><i class="glyphicon glyphicon-plus"></i></a> </h1>
 <hr>
 <div class="row">
     <div class="col-md-4">
         <div>
             {news}
             <div class="list-group-item">
                 {title} <span class="badge"> {date}</span>
             </div>
             {/news}
         </div>
     </div>
 </div>
