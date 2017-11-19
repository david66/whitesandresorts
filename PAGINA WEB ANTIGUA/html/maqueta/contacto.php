<?php include "header.php"; ?>

 <div id="migas">Avalia > Contacto</div>
 <div id="contenido">
  <div id="galeria"><img id="imagen_principal" src="images/foto-principal.jpg"/></div>
  <div id="info">
    <p id="vivienda">Contacto</p>
    <div>
      <form><table>
  <tr>
    <td class="nombre-campo">Nombre*</td>
    <td><input name="nombre" id="nombre" type="text" /></td>
    <td class="nombre-campo">Apellidos</td>
    <td><input name="apellidos" id="apellidos" type="text" /></td>
  </tr>
  <tr>
    <td class="nombre-campo">Email *</td>
    <td><input name="email" id="email" type="text" /></td>
    <td class="nombre-campo">Telefono</td>
    <td><input name="telefono" id="telefono" type="text" /></td>
  </tr>
  <tr>
    <td class="nombre-campo">Mensaje</td>
    <td colspan="3"><textarea name="mensaje" id="mensaje" cols="" rows=""></textarea></td>
  </tr>
  <tr>
    <td class="nombre-campo"></td>
    <td></td>
    <td class="nombre-campo"></td>
    <td><input class="button" name="" value="Enviar" type="button" /></td>
  </tr>
 
  
</table></form>

      
    </div>
  </div>
 </div>
</div>

<?php include "foot.php"; ?>