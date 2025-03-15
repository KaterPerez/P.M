<?php include("controllers/clisin.php"); ?>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="d-flex align-items-center py-3 mb-0.5">
        <h1 class="me-3">Instituciones en el sistema</h1>
        <button id="toggleForm" class="btn btn-dark">
          <i class="fa-solid fa-plus"></i>
        </button>
      </div>
    </div>
  </div>
  <form name="frm1" action="#" method="POST" class="toggleForm" style="display:none;">
    <div class="row">
      <div class="form-group col-md-4">
        <label for="depubi">Departamento</label>
        <select class="form-control form-select" id="depubi" name="depubi" onchange="reloadMun(this.value)">
          <option value="0">Selecciona Departamento</option>
          <?php if(isset($dep) && is_array($dep)) { foreach($dep as $d) { ?>
            <option value="<?=$d['codubi'];?>" <?php if(isset($dtOne) && is_array($dtOne) && $dtOne && $dtOne[0]['depubi']==$d['codubi']) echo "selected"; ?>><?=$d['nomubi'];?></option>
          <?php }} ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="munubi">Municipio</label>
        <div id="reload">
          <select class="form-control form-select" id="munubi" name="munubi">
            <option value="0">Selecciona Municipio</option>
            <?php if(isset($dtMuni) && is_array($dtMuni)) { foreach($dtMuni as $m) { ?>
              <option value="<?=$m['codubi'];?>" <?php if(isset($dtOne) && is_array($dtOne) && $dtOne && $dtOne[0]['munubi']==$m['codubi']) echo "selected"; ?>><?=$m['nomubi'];?></option>
            <?php }} ?>
          </select>
        </div>
      </div>
      <div class="form-group col-md-4">
        <label for="nuicie">Codigo Ins.</label>
        <input type="text" class="form-control" id="nuicie" name="nuicie" required>
      </div>
      <input type="hidden" name="ope" value="save">
      <div class="form-group col-md-4">
        <br>
        <input type="submit" class="btn btn-dark" value="Buscar">
      </div>
    </div>
  </form>
  <table id="example" class="table table-striped" style="width:100%">
    <br>
    <thead>
      <tr>
        <th>Nombre Ins.</th>
        <th>Codigo Ins.</th>
        <th>Departamento</th>
        <th>Municipio</th>
        <th>Correo Ins.</th>
        <th>Numero Ins.</th>
      </tr>
    </thead>
    <tbody>
      <?php if(isset($datOne) && is_array($datOne)) { foreach($datOne as $dat) { ?>
      <tr>
        <td><?=$dat["nomie"];?></td>
        <td><?=$dat["nuicie"];?></td>
        <td><?=$dat["depubi"];?></td>
        <td><?=$dat["munubi"];?></td>
        <td><?=$dat["corie"];?></td>
        <td><?=$dat["telie"];?></td>
      </tr>
      <?php }} ?>
    </tbody>
    <tfoot>
      <tr>
        <th>Nombre Ins.</th>
        <th>Codigo Ins.</th>
        <th>Departamento</th>
        <th>Municipio</th>
        <th>Correo Ins.</th>
        <th>Numero Ins.</th>
      </tr>
    </tfoot>
  </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function reloadMun(departmentId) {
    if (departmentId !== "0") {
      $.ajax({
        url: 'controllers/clisin.php',
        type: 'POST',
        data: {depubi: departmentId, ope: 'getMunicipios'},
        success: function(response) {
          $('#reload').html(response);
        },
        error: function() {
          alert('Error al cargar los municipios.');
        }
      });
    }
  }

  $(document).ready(function() {
    $("#toggleForm").click(function() {
      $(".toggleForm").slideToggle();
      var icon = $(this).find("i");
      if (icon.hasClass("fa-plus")) {
        icon.removeClass("fa-plus").addClass("fa-minus");
      } else {
        icon.removeClass("fa-minus").addClass("fa-plus");
      }
    });
  });
</script>