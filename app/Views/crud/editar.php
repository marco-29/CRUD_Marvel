<form action="<?php echo base_url('crud/agregar/'.$personaje['identficador'])?>" method="POST">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="nombre" value="<?php set_value('nombre'); ?>">
  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" id="descripcion" class="form-control" value="<?php set_value('descripcion'); ?>"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>