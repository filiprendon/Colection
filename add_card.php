<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                Añade un pokémon
            </div>
            <div class="card-body">
                <form action="tabla.php" method="GET">
                    <div class="row mb-3">
                        <label for="txtNombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="txtNombre" id="txtNombre"
                                placeholder="Introduce el nombre">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="cbxCurso" class="col-sm-2 col-form-label">Ciclo</label>
                        <div class="col-sm-10">
                            <select name="cbxCurso" class="form-select" id="cbxCurso">
                                <option value="daw2a">DAW2A</option>
                                <option value="daw2b">DAW2B</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rbTurno" class="col-sm-2 col-form-label">Turno</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="rbTurno" id="rbMañana" checked class="custom-control-input"
                                    value="Mañana">
                                <label class="custom-control-label" for="rbMañana">Mañana</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="rbTurno" id="rbTarde" class="custom-control-input"
                                    value="Tarde">
                                <label class="custom-control-label" for="rbTarde">Tarde</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <label class="form-check-label" for="flexCheckDefault">
                                Actiu
                            </label>
                        </div>

                        <div class="col-sm-10">
                            <input class="form-check-input col-sm-10" type="checkbox" value="" id="flexCheckDefault">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-10">
                            <div class="position-absolute bottom-0 end-0 p-2">
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                                <button type="submit" class="btn btn-secondary">Cancelar</button>
                            </div>
                        </div>
                    </div>

            </div>
            </form>
        </div>
    </div>
    </div>

</body>

</html>