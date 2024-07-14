<!-- <?= d($personajes); ?> -->
<!-- <?php print_r($db_llena); ?> -->

<div class="container p-5">
    <h1>Peronajes de marvel</h1>
    <div class="card">
        <div class="card-body">
            <!-- validar si el array existe y si tiene al menos uno -->
            <?php if (isset($personajes) && count($personajes)) : ?>
                <div class="mb-3">
                    <select name="personaje" id="personaje" class="form-control">
                        <?php foreach ($personajes as $key => $personaje) : ?>
                            <option value="<?= esc($personaje['id'], 'attr'); ?>"><?= esc($personaje['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" value="Buscar" class="btn btn-primary" id="buscar">
            <?php else : ?>
                <div class="alert alert-info">No se encontraron resultados</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="float-end">
            <button type="button" class="btn btn-secondary">Agregar +</button>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Identificador</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha de registro</th>
                        <th scope="col">Fecha de actualización</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($db_llena as $key => $personaje) : ?>
                        <tr>
                            <th scope="row"><?php echo $personaje['id']; ?></th>
                            <td><?php echo $personaje['identificador']; ?></td>
                            <td><?php echo $personaje['nombre']; ?></td>
                            <td><?php echo $personaje['descripcion']; ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($personaje['fecha_registro'])); ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($personaje['fecha_actualizacion'])); ?></td>
                            <td><a href="">Editar</a> | <a href="Eliminar">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- <?php print_r($personajes); ?> -->