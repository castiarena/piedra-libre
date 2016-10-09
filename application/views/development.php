<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title> <?= $title?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= site_url('assets/css/admin.css')?>">
</head>
<body>
<main>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo-admin">
                    <img src="<?= site_url('assets/img/iso.svg') ?>" class="center-block" alt="Logo">
                </div>
                <h1 class="text-center">Acceso al sitio</h1>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <form action="development" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default ">Entrar</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>

        </div>
    </div>

</main>

</body>
</html>