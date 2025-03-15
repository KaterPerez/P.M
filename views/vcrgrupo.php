<?php include("controllers/cfas.php") ?>

<div class="container">
  
  <div class="row">
    <div class="col-md-6">
      <div class="d-flex align-items-center py-3 mb-0.5">
        <h1 class="me-3" >Crear proyecto</h1>
        <button id="toggleForm" class="btn btn-dark">
          <i class="fa-solid fa-plus"></i>
        </button>
      </div>
    </div>
  </div>


  <form name="frm1" action="#" method="POST" class="toggleForm" style="display:none;">
  <div class="row">
    <div class="form-group col-md-4">
      <label for="nomubi">Nombre del proyecto</label>
      <input type="text" name="nomfas" id="nomfas" class="form-control form-control" required>
    </div>
    <div class="form-group col-md-4">
      <label for="disabledSelect" class="form-label">Grupo</label>
        
      <select class="form-control form-select" id="codgru" name="codgru">
        <option value="0">Seleccione Proyecto</option>
        <?php if($dtDtp){ foreach($dtDtp as $dtD){ ?>
        <option value="<?=$dtD['codpro'];?>" <?php if($dtOne && $dtOne[0]['nompro']==$dtD['codpro']) echo "selected"; ?>><?=$dtD['nompro'];?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="nomubi">Tema del proyecto</label>
      <select class="form-control form-select" id="codgru" name="codgru">
        <option value="0">Seleccione tema del proyecto</option>
          <?php if($dtDtp){ foreach($dtDtp as $dtD){ ?>
        <option value="<?=$dtD['codpro'];?>" <?php if($dtOne && $dtOne[0]['tempro']==$dtD['codpro']) echo "selected"; ?>><?=$dtD['tempro'];?></option>
          <?php }} ?>
      </select>
    </div>
    <div class="form-group col-md-10 ">
      <br>
      <input type="hidden" name="ope" value="savef">
      <input type="hidden" name="codpro" required>
      <input type="submit" class="btn btn-dark" value="Enviar">
    </div>
  </div>
</form>

<table id="example" class="table table-striped" style="width:100%">
  <br>
  <thead>
    <tr>
      <th>Nombre del proyecto</th>
      <th>Nombre del grupo</th>
      <th>Tema de proyecto</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php if($datOne){foreach($datOne AS $dat){ ?> 
      <tr> 
        <td><?=$dat["nompro"]; ?></td>
        <td><?=$dat["nomgru"]; ?></td> 
        <td><?=$dat["tempro"]; ?></td> 
        <th></th> 
        <th><input type="button" name="ope" value="ope" class="btn btn-primary fa-truck-ramp-box"></th> 
      </tr> 
    <?php }} ?>
  </tbody>
  <tfoot>
    <tr>
      <th>Nombre del proyecto</th>
      <th>Nombre del grupo</th>
      <th>Tema de proyecto</th>
      <th></th>
    </tr>
  </tfoot>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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