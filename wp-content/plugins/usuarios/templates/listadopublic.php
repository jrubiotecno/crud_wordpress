<?
class listadoPublic {
	function listadoPublic($infoUsuarios) {
?>
<table id="tablainfo" cellpadding="0" cellspacing="0" width="80%" align=center>
	<tr>
		<th>Nombre</th><th>Email</th><th>Fecha nacimiento</th>
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
						<td>" . $users_row -> nombre . "</td>
						<td>" . $users_row -> email . "</td>
						<td>" . $users_row -> fechanacimiento . "</td>
					</tr>";
    }
	?>
</table>
<?
}
}
?>