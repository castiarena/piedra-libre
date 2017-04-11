<section>
    <div class="banner banner-static banner-seccion">
        <div class="container text-center">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="header-title font-title text-uppercase"><strong>Contacto</strong></h2>
                <br><br>
                <p class="color-blanco font-title text-uppercase">Escribinos</p>
            </div>
        </div>
        <a href="#" class="color-blanco font-xl banner-scroll"></a>
    </div>
</section>

<section>
    <div class="container container-l">
        <form action="contacto" method="post">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Formulario de contacto</h2>
                    <p>Consulta sobre como podes ayudarnos:</p>
                    <?php if($status === 'enviado'):?>
                    <p class="alert alert-success">Enviamos tu email, gracias por escribirnos</p>
                    <?php endif;?>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input required class="form-control" type="text" name="name" id="name" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Apellido:</label>
                                <input required class="form-control" type="text" name="lastname" id="lastname" placeholder="Apellido">
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input required class="form-control" type="text" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="name">Asunto:</label>
                        <input required class="form-control" type="text" name="subject" id="subject" placeholder="Asunto">
                    </div>
                    <div class="form-group">
                        <label for="description">Comentarios:</label>
                        <textarea required class="form-control" name="comments" id="comments" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <p>El refugio de arenales:</p>
                    <div class="img-thumbnail" id="map" style="width: 100%; height: 420px"></div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-ghost-two">Enviar</button>
                    <button type="reset" class="btn btn btn-ghost-two">Borrar</button>
                </div>

            </div>
        </form>

    </div>
</section>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1boInb_GxMo9JBBhlmIwr8Woa9I2Wk6E&callback=initMap">
</script>
<script>
    function initMap() {
        var arenales = {lat: -33.6251905, lng: -69.5178189};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: arenales,
            mapTypeId: 'satellite'
        });
        var marker = new google.maps.Marker({
            position: arenales,
            map: map
        });
    }
</script>