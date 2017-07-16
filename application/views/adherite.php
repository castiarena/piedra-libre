
<section>
    <div class="banner banner-static banner-seccion">
        <div class="container text-center">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="header-title font-title text-uppercase">Formá parte - <strong>Adherite</strong></h2>
                <br><br>
                <p class="color-blanco font-title text-uppercase">Unite a la fundación, completa el siguiente formulario <br>  y enterate de todas las novedades</p>
            </div>
        </div>
        <a href="#" class="color-blanco font-xl banner-scroll"></a>
    </div>
</section>

<section>
    <form action="<?= site_url('adherite')?>" method="post" class="container container-l">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center">COMISION DE AMIGOS DE LA FUNDACION PIEDRA LIBRE</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <div class="container-xs">
                    <h2>Ficha personal</h2>
                    <p>Mediante la presente, solicito formar parte de la Comisión de Amigos de la Fundación Piedra Libre, adhiriendo a sus  objetivos ambientales y deportivos:</p>
                    <p>Proteger espacios físicos que por sus características naturales sean aptos para las prácticas del montañismo y la escalada, promoviendo las prácticas para el cuidado del medio ambiente, preservando la naturaleza original de estos escenarios, garantizando la accesibilidad y colaborando activamente con la gestión de un uso armónico y sustentable.</p>
                    <p><a href="http://localhost/piedra-libre/quienes-somos/objeto-de-la-fundacion" target="_blank">Objeto completo de la Fundación Piedra Libre</a></p>

                    <p>ACLARACIÓN: La adhesión a esta comisión es totalmente GRATUITA. Los datos que envíes mediante este formulario no serán publicados en la web ni en ningún otro lugar. Sólo serán utilizados por la Fundación para adherirte al objeto de la misma con el aval de su escribano. </p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row container-xs">
                    <div class="col-sm-12">
                        <h2>Formulario de inscripción</h2>
                        <!--div class="container-xs">
                            <p>Completa el formulario a mano o usando alguna red social:</p>
                            <a href="#" class="btn btn-info">facebook</a>
                            <a href="#" class="btn btn-info">gmail</a>
                            <a href="#" class="btn btn-info">twitter</a>
                        </div-->
                        <?= $errors?>
                        <?= $success?>
                    </div>
                    <div class="col-sm-6">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name"
                               placeholder="Nombre" required/>
                    </div>
                    <div class="col-sm-6">
                        <label for="last_name">Apellido</label>
                        <input type="text" class="form-control" name="last_name"
                               placeholder="Apellido" required/>
                    </div>
                </div>
                <div class="row container-xs">
                    <div class="col-sm-12">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email"
                               placeholder="Email" required/>
                    </div>
                </div>
                <div class="row container-xs">
                    <div class="col-sm-7">
                        <label for="document">Documento</label>
                        <input type="text" class="form-control" name="document"
                               data-number minlength="5"
                               placeholder="Nro. de documento" required/>
                    </div>
                    <div class="col-sm-5">
                        <label for="document_type">Tipo</label>
                        <select name="document_type" id="document_type" class="form-control" required>
                            <option value="dni" selected>DNI</option>
                            <option value="rut">RUT</option>
                            <option value="passport">Pasaporte</option>
                        </select>
                    </div>
                </div>
                <div class="row container-xs">
                    <div class="col-sm-12">
                        <label for="birth">Fecha de nacimiento</label>
                        <input type="text" data-date--picker class="form-control"
                               name="birth" readonly
                               placeholder="dd/mm/aaaa" required/>
                    </div>
                </div>
                <div class="row container-xs">
                    <div class="col-sm-6">
                        <label for="residence">Domicilio completo</label>
                        <input type="text" class="form-control" name="residence"
                               placeholder="Ej: Av. Rivadavia 554, Caballito, Capital Federal" required/>
                    </div>
                    <div class="col-sm-6">
                        <label for="country">País</label>

                        <select name="country" id="country" class="form-control" required>
                            <option value="-1">Seleccionar país</option>
                            <?php foreach($countries as $key => $contry):?>
                                <option value="<?= $key?>"
                                    <?=$key === 'AR' ? 'selected' : ''?>>
                                    <?=$contry?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="row container-xs">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary text-uppercase">Inscribirme!</button>
                    </div>
                </div>
            </div>

        </div>

    </form>
</section>