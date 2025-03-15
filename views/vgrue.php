<?php include("controllers/cfas.php") ?>

<div class="container">

	<div class="row">
    <div class="col-md-6">
      <div class="d-flex align-items-center py-3 mb-0.5">
        <h1 class="me-3" >Crear grupos</h1>
        <button id="toggleForm" class="btn btn-dark">
          <i class="fa-solid fa-plus"></i>
        </button>
      </div>
    </div>
  </div>


	<form name="frm1" action="#" method="POST" class="toggleForm" style="display:none;">
		<div class="row">
			<div class="form-group col-md-4">
				<label for="disabledSelect" class="form-label">Curso</label>

				<select class="form-control form-select" id="codcur" name="codcur">
        			<option value="0">Seleccione curso</option>
        			<?php if($dtDtp){ foreach($dtDtp as $dtD){ ?>
        			<option value="<?=$dtD['codcur'];?>" <?php if($dtOne && $dtOne[0]['nomcur']==$dtD['codcur']) echo "selected"; ?>><?=$dtD['nomcur'];?></option><?php }} ?>
     			</select>
			</div>
			<div class="form-group col-md-4">
				<label for="nomgru">Nombre del grupo</label>
				<br>
				<input type="text" name="nomgru" id="nomgru" class="form-control form-control" required> 
			</div>
			<div class="form-group col-md-4">
				<label for="num_integrantes" class="form-label">Cantidad de integrantes</label> 
				<select id="num_integrantes" name="num_integrantes" class="form-select" onchange="mostrarIntegrantes(this.value)" required> 
					<option value="">No. Integrantes</option> 
					<?php for ($i = 1; $i <= 5; $i++) { echo "<option value='$i'>$i</option>"; } ?> 
				</select> 
			</div>
			<!-- <div id="integrantes_container" class="row"></div> -->
			<div class="form-group col-md-10"> 
				<br>
				<input type="hidden" name="ope" value="save"> 
				<input type="hidden" name="codubi" required> 
				<input type="submit" class="btn btn-dark" value="Enviar"> 
			</div>
		</div>
	</form>

	<br>

	<table id="example" class="table table-striped" style="width:100%">
		<thead>
			<tr>
				<th>Curso</th>
				<th>Nombre G.</th>
				<th>Integrantes</th> 
				<th></th> 
				<th>Opciones</th> 
			</tr>
		</thead>
		<tbody>
			<?php if($datOne){foreach($datOne AS $dat){ ?> 
			<tr> 
				<td><?=$dat["nomcur"]; ?></td>
				<td><?=$dat["nomgru"]; ?></td>
				<td><?=$dat["idusu"]; ?></td>
				<td></td> 
				<td><input type="button" name="ope" value="ope" class="btn btn-primary fa-truck-ramp-box"></td> 
			</tr>
		</tbody>
    <?php }} ?>
		</tbody>
		<tfoot>
			<tr>
				<th>Curso</th>
				<th>Nombre G.</th>
				<th>Integrantes</th>
				<th></th> 
				<th>Opciones</th>
			</tr>
		</tfoot>
	</table>
</div>

<script>
	function mostrarIntegrantes(num) {
		var container = document.getElementById('integrantes_container'); 
		container.innerHTML = ''; // Limpiar los campos anteriores

		for (var i = 1; i <= num; i++) {
			var div = document.createElement('div');
			div.className = 'form-group col-md-3';

			var select = document.createElement('select');
			select.name = 'integrante_' + i;
			select.id = 'integrante_' + i;
			select.className = 'form-select';
			select.required = true;

			var defaultOption = document.createElement('option');
			defaultOption.value = '';
			defaultOption.textContent = 'Seleccione Integrante';
			select.appendChild(defaultOption);

			estudiantes.forEach(function(estudiante) {
				var option = document.createElement('option');
				option.value = estudiante.id;
				option.textContent = estudiante.nomusu + ' ' + estudiante.apeusu;
				select.appendChild(option); 
			});

			div.appendChild(select);
			container.appendChild(div);
		}
	}
</script>

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