<!-- <div class="container p-5">
    <h1>Peronajes de marvel</h1>
    <div class="card">
        <div class="card-body">
            validar si el array existe y si tiene al menos uno
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
</div> -->

<section>
    <div class="container p-5">

        <?php if (session()->getFlashdata('error') != null) : ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('exito') != null) : ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('exito'); ?>
            </div>
        <?php endif; ?>

        <div class="offset-lg-11">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregar">Agregar +</button>
            <!-- <a href="<?php echo base_url('crud/agregar') ?>"><button type="button" class="btn btn-secondary">Agregar +</button></a> -->
        </div>

        <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('crud') ?>" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Agregar +</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-3">
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
                    <?php foreach ($query_pag as $key => $personaje) : ?>
                        <tr>
                            <th scope="row"><?php echo $personaje->id; ?></th>
                            <td><?php echo $personaje->identificador; ?></td>
                            <td><?php echo $personaje->nombre; ?></td>
                            <td><?php echo $personaje->descripcion; ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($personaje->fecha_registro)); ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($personaje->fecha_actualizacion)); ?></td>
                            <td><a href="<?php echo base_url('crud/' . $personaje->id . '/edit'); ?>"><button type="button" class="btn btn-info btn-sm">Editar</button></a> <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-url="<?php echo base_url('crud/' . $personaje->id); ?>">Eliminar</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?= $pager_links; ?>

            <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminaModalLabel">Aviso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Deseas eliminar este personaje?</p>
                        </div>
                        <div class="modal-footer">
                            <form id="form-eliminar" action="<?php echo base_url('crud') ?>" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const eliminaModal = document.getElementById('eliminaModal')
                if (eliminaModal) {
                    eliminaModal.addEventListener('show.bs.modal', event => {
                        // Toma las prodpiedades del boton que se definio en html
                        const button = event.relatedTarget
                        // Extare el atributo data-bs-url
                        const url = button.getAttribute('data-bs-url')

                        // Busca el elmento en el formualrio del modal con id=form-eliminar y al action le pasamos la url del boton.
                        const form = eliminaModal.querySelector('#form-eliminar')
                        form.setAttribute('action', url)
                    })
                }
            </script>
        </div>
    </div>
</section>