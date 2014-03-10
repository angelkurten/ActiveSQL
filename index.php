<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ActiveSQL</title>
  <!--<meta http-equiv="refresh" content="5">-->
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/jquery.js"></script>
  <script src="assets/index.js"></script>
</head>
<body>
  <?php 
    require_once('core/active.php');

    $ac->join('departamentos','departamentos.Cod_Dpto=personas.Cod_Dpto');
    $ac->join('ciudades','ciudades.Cod_Ciudad=personas.Cod_Ciudad');
    $user=$ac->get('personas')->object();

    $dpto=$ac->get('departamentos')->object();
    $ciud=$ac->get('ciudades')->object();
  ?>
  <div id="container">
    <header>
      <h1>Ejemplo ActiveSQL</h1>
      <h6>Click en la operacion deseada</h6>
    </header>
    <section id="opciones">
      <ul>
        <li id="listar" onclick="listar();">Listar Usuarios</li>
        <li id="agregar" onclick="agregar()">Agregar Usuario</li>
        <li id="eliminar" onclick="eliminar()">Eliminar Usuario</li>
        <li id="actualizar" onclick="actualizar()">Actualizar Usuario</li>
      </ul>
    </section>
    <section id="modulo">
      <table id="moduloListar">
        <thead>
          <th>Codigo</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Departamento</th>
          <th>Ciudad</th>
        </thead>
        <?php foreach ($user as $key => $value): ?>
              <tr>
                  <td><?php echo $value->Ced_Persona ?></td>
                  <td><?php echo $value->Nom_Persona ?></td>
                  <td><?php echo $value->Ape_Persona ?></td>
                  <td><?php echo $value->Nom_Dpto ?></td>
                  <td><?php echo $value->Nom_Ciudad ?></td>
                </tr>
        <?php endforeach ?>
      </table>
      <section style="display:none" id="moduloAgregar">
        <?php if (!isset($_POST['ced'])){ ?>
          <form method="post">
          <input type="hidden" id="mod" name="mod" value="agregar">
          <input type="text" id="ced" name="ced" placeholder="Cedula" required>
          <br>
          <input type="text" id="nom" name="nom" placeholder="Nombre" required>
          <br>
          <input type="text" id="ape" name="ape" placeholder="Apellido" required>
          <br>
          <input type="text" id="dir" name="dir" placeholder="Direccion" required>
          <br>
          <input type="text" id="tel" name="tel" placeholder="Telefono" required>
          <br>
          Departamento: 
          <select name="dep" id="dep">
            <?php foreach ($dpto as $key => $value): ?>
              <option value="<?php echo $value->Cod_Dpto; ?>"><?php echo $value->Nom_Dpto; ?></option>
            <?php endforeach ?>
          </select>
          <br>
          Ciudad: 
          <select name="ciud" id="ciud">
            <?php foreach ($ciud as $key => $value): ?>
              <option value="<?php echo $value->Cod_Ciudad; ?>"><?php echo $value->Nom_Ciudad; ?></option>
            <?php endforeach ?>
          </select>
          <br>
          <input type="submit" id="btnAgregar">
        </form>
        <?php }
        else{

            if($_POST['mod']=="agregar"){
            ?>
              <script>
               agregar();
              </script>
            <?php
            }
          $array=array($_POST['ced'],
              $_POST['nom'], 
              $_POST['ape'], 
              $_POST['dir'],
              $_POST['tel'],
              $_POST['ciud'],
              $_POST['dep']);
          //guardo los campos a guardar
          $ac->values($array);
          $result=$ac->save('personas');
          if($result){
            echo "El usuario fue ingresado con exito";
          }
          else{
            echo "No se ha podido ingresar el usuario";
          }
        }
        ?>
      </section>
      <section style="display:none" id="moduloEliminar">
        <form method="POST">
          <input type="text" id="cede" name="cede" placeholder="Codigo del usuario">
          <input type="hidden" name="mod" value="eliminar">
          <input type="submit" value="Eliminar">
        </form>
        <?php
          if(isset($_POST['cede'])){
            if($_POST['mod']=="eliminar"){
            ?>
              <script>
               eliminar();
              </script>
            <?php
            }
            $array=array('Ced_Persona'=>$_POST['cede']);
            $ac->where($array);
            $result=$ac->delete('personas');
            if($result){
              echo "El usuario fue eliminado con exito";
            }
            else
              echo "El usuario no fue eliminado";
          }
        ?>
      </section>
      <section style="display:none" id="moduloActualizar">
        
      </section>
    </section>
  </div>
</body>
</html>
