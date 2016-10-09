 <h1>Cargar una Noticia </h1>
 <hr>
 <form action="<?= site_url('admin/news/create')?>" method="post">
 <div class="row">
     <div class="col-md-4">
         <? if(isset($errors['form'])){?>
             <div class="alert alert-danger"><?= $errors['form'] ?></div>
         <? } ?>
         <? if(isset($errors['image'])){?>
             <div class="alert alert-danger"><?= $errors['image']['error'] ?></div>
         <? } ?>
         <div class="form-group">
             <small>Titulo:</small>
             <input type="text" name="title" placeholder="Titulo" class="form-control">
         </div>
         <div class="form-group">
             <small>Fecha:</small>
             <input type="date" name="date" value="<?= date('d/m/Y')?>" placeholder="Fecha" class="form-control">
         </div>
         <div class="form-group">
             <small>Descripcion:</small>
             <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Descripcion"></textarea>
         </div>
     </div>
    <div class="col-md-4">
        <div class="form-group">
            <small>Tag:</small>
            <select name="tag" id="tag" class="form-control">
                <option value="-1">Elegir tag</option>
                {tags}
                <option value="{id}">{name}</option>
                {/tags}
            </select>

        </div>
        <div class="form-group">
            <small>Agregar una imagen</small>
            <input type="file" placeholder="Subir imagen" accept="image/*" class="form-control" name="image" id="image">
        </div>
    </div>
     <div class="col-md-4">
         <br>
     </div>
 </div>
 <div class="row">
     <div class="col-md-4">
         <div class="form-group">
             <div class="btn-group btn-group-justified">
                 <div class="btn-group">
                     <button type="submit" class="btn btn-success">Cargar</button>
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

