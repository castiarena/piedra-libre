 <h1 class="page-header">Cargar un Evento </h1>
 <form action="<?= site_url('admin/events/create')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
 <div class="row">
     <div class="col-md-8">
         <div class="col-md-6">
             <div class="form-group">
                 <small>Titulo:</small>
                 <input type="text" name="title" placeholder="Titulo" class="form-control">
             </div>
             <div class="form-group">
                 <small>Fecha:</small>
                 <input type="date" name="date" placeholder="Fecha" class="form-control">
             </div>
             <div class="form-group">
                 <small>Tag:</small>
                 <select name="tag" id="tag" class="form-control">
                     <option value="-1">Elegir tag</option>
                     {tags}
                     <option value="{id}">{name}</option>
                     {/tags}
                 </select>
             </div>
         </div>
         <div class="col-md-6">
             <div class="form-group">
                 <small>Agregar una imagen</small>
                 <input type="file" placeholder="Subir imagen" accept="image/*" class="form-control" name="image" id="image">
             </div>
             <? if(isset($errors['form']) || isset($errors['image'])){?>
                 <div class="form-group">
                     <small class="text-danger">Errors:</small>
                     <div class="alert alert-danger">
                         <? if(isset($errors['form'])){ echo $errors['form']; } ?>
                         <? if(isset($errors['image'])){ echo $errors['image']; } ?>
                     </div>
                 </div>
             <? } ?>
         </div>

         <div class="col-md-12">
             <div class="form-group">
                 <small>Descripcion:</small>
                 <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Descripcion"></textarea>
             </div>
         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-md-4">
         <div class="form-group">
             <div class="btn-group btn-group-justified">
                 <div class="btn-group">
                     <button type="submit" class="btn btn-success" name="submit">Cargar</button>
                 </div>
                 <div class="btn-group">
                     <button type="reset" class="btn btn-default">Borrar</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </form>
 <hr>

