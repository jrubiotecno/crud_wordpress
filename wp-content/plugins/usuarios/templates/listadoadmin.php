<?
class listadoAdmin {
	function listadoAdmin($infoUsuarios,$msg="",$link) {
?>	<div id="icon-users" class="icon32">
	<br/>
	</div>
	<h2>Listado de Usuarios</h2>
	<div style="width: 60px; margin: 0 auto;">
		<input type="button" value="Agregar" class="button-primary" onclick="javascript:window.location.href='<?=$link."&op1=forma&op2=0"?>'" /> 
	</div>
	<br />
	<table id="tablainfo" cellpadding="0" cellspacing="0" width="80%" align=center>
		<tr>
			<th>Id</th><th>Nombre</th><th>Email</th><th>Fecha nacimiento</th><th>Editar</th><th>Borrar</th>
		</tr>
		<?
		$estilo = "one";
		foreach ($infoUsuarios as $users_row) {
			if ($estilo == "one") {
				$estilo = "two";
			} else {
				$estilo = "one";
			}
			print "<tr class='" . $estilo . "'>
						<td>" . $users_row -> idusuario . "</td>
						<td>" . $users_row -> nombre . "</td>
						<td>" . $users_row -> email . "</td>
						<td>" . $users_row -> fechanacimiento . "</td>
						<td><a href='"."$link"."&op1=forma&op2=".$users_row -> idusuario . "'>Editar</a></td>
						<td><a href='"."$link"."&op1=borrar&op2=".$users_row -> idusuario . "'>Borrar</a></td>
					</tr>";
		}
	?>
	</table>
	<div style="width: 110px; margin: 0 auto;">
	<span style="color: red; font-size: 10px;font-weight: bold;"><?=$msg?></span>
	</div>
<?
	}
}
?>