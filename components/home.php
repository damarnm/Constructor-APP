<div class="header container-fluid bg-dark text-start p-2">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="./?section=home" class="btn btn-primary active">Home</a>
    </div>
</div>

<div class="container-fluid">
    <h5 class="text-start">
        Crear un proyecto con PHP y MySQL
    </h5>
    <form class="form text-start form-create">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del proyecto</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del proyecto" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Escriba el nombre de su proyecto, se recomienda no usar espacios ni caracteres especiales</small>
        </div>
        <div class="mb-3">
            <select name="db" id="db">
                <option value="false">False</option>
                <option value="true">True</option>
            </select>
            <small id="helpId" class="text-muted">Seleccione true si desea crear base de datos</small>
        </div>
        <div class="display-db">
            <div class="mb-3">
                <label for="nameDB" class="form-label">Nombre de base de datos</label>
                <input type="text" name="nameDB" id="nameDB" class="form-control" placeholder="Nombre de base de datos" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Escriba el nombre de la base de datos</small>
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Usuario de base de datos</label>
                <input type="text" name="user" id="user" class="form-control" placeholder="Usuario de base de datos" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Escriba el nombre de usuario de la base de datos</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña de base de datos</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Contraseña de base de datos" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Escriba la contraseña de la base de datos</small>
            </div>
        </div>
        <button type="submit" class="btn btn-primary create-proyect">Crear proyecto</button>
        <style>
            .display-db {
                display: none;
            }
        </style>
    </form>

</div>