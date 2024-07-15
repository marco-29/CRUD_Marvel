<section class="mb-5">
  <div class="container p-5">
    <h2>Editar personaje <?php echo $personaje['nombre']; ?></h2>
    <form action="<?php echo base_url('crud/' . $personaje['id']); ?>" method="POST" class="mt-5">

      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="personaje_id" value="<?php echo $personaje['id'] ?>">

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $personaje['nombre']; ?>">
        <!-- value="<?php set_value('nombre'); ?>" -->
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" value="<?php echo $personaje['descripcion']; ?>"><?php echo $personaje['descripcion']; ?>
        </textarea>
      </div>
      <a href="<?php echo base_url('crud')?>"class="btn btn-secondary">Regresar</a>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</section>