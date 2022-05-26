<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/customColors.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/index.css" media="screen,projection" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario</title>
</head>

<body>
  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="index.php" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad</option>
              <?php
              $jsonData = file_get_contents("data-1.json");
              $myArray = json_decode($jsonData, "false");

              for ($i = 0; count($myArray) > $i; $i++) {
                if (!isset($city[$myArray[$i]['Ciudad']])) {
                  $city[$myArray[$i]['Ciudad']] = 1;
                }
              }

              $city = array_keys($city);
              foreach ($city as $ciudad) {
                echo "<option value='$ciudad'>" . $ciudad . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <?php
              $jsonData = file_get_contents("data-1.json");
              $myArray = json_decode($jsonData, "false");

              for ($i = 0; count($myArray) > $i; $i++) {
                if (!isset($type[$myArray[$i]['Tipo']])) {
                  $type[$myArray[$i]['Tipo']] = 1;
                }
              }

              $type = array_keys($type);
              foreach ($type as $tipo) {
                echo "<option value='$tipo'>" . $tipo . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>

    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Mis bienes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>
            <?php
            $jsonData = file_get_contents("data-1.json");
            $myArray = json_decode($jsonData, true);

            foreach ($myArray as $index => $description) {
              echo "<div style='padding: 5px; justify-content: center'> <img src='./img/home.jpg' width='200' height='200'> </div>";
              echo "Direccion: $description[Direccion]<br>";
              echo "Ciudad: $description[Ciudad]<br>";
              echo "Telefono: $description[Telefono]<br>";
              echo "Codigo Postal: $description[Codigo_Postal]<br>";
              echo "Tipo: $description[Tipo]<br>";
              echo "Precio: $description[Precio]<br>";
              echo "<br>";

              $direccion = $description["Direccion"];
              $ciudad = $description["Ciudad"];
              $telefono = $description["Telefono"];
              $codigo_postal = $description["Codigo_Postal"];
              $tipo = $description["Tipo"];
              $precio = $description["Precio"];


              echo "<a style='height: 40px; width: 200px; margin-bottom: 10px; background: #648C7D; border-radius: 10px; color: white;' href='insert.php?ciudad=$ciudad&telefono=$telefono&codigo_postal=$codigo_postal&tipo=$tipo&precio=$precio'></a>";
              echo '<div class="divider"></div>';
            }
            ?>
          </div>
        </div>
      </div>

      <div id="tabs-2">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <?php
            include('db_connection.php');
            $query = "SELECT * FROM bienes";
            if ($result = $conn->query($query)) {
              while ($row = $result->fetch_assoc()) {
                $field0name = $row["id"];
                $field1name = $row["direccion"];
                $field2name = $row["ciudad"];
                $field3name = $row["telefono"];
                $field4name = $row["cod_postal"];
                $field5name = $row["tipo"];
                $field6name = $row["precio"];


                echo "<div style='padding: 5px; justify-content: center'> <img src='./img/home.jpg' width='200' height='200'> </div>";
                echo "Direccion: $field1name<br>";
                echo "Ciudad: $field2name<br>";
                echo "Telefono: $field3name<br>";
                echo "Codigo Postal: $field4name<br>";
                echo "Tipo: $field5name<br>";
                echo "Precio: $field6name<br>";
                echo "<br>";
                echo "<a style='height: 40px; width: 200px; margin-bottom: 10px; background: #648C7D; border-radius: 10px; color: white;' href='delete.php?id=$field0name'></a>";
                echo ' <div class="divider"></div>';
              }
              $result->free();
            }
            ?>
          </div>
        </div>
      </div>
      <div id="tabs-3">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Exportar Reportes:</h5>
            <div class="divider"></div>
            <h5 align="center">Filtros</h5>
            <div class="filtroCiudad input-field">
              <p><label for="selectCiudad">Ciudad:</label><br></p>
              <select name="ciudad" id="selectCiudad">
                <option value="" selected>Elige una ciudad</option>

              </select>
            </div>
            <div class="filtroTipo input-field">
              <p><label for="selecTipo">Tipo:</label></p>
              <br>
              <select name="tipo" id="selectTipo">
                <option value="">Elige un tipo</option>

              </select>
            </div>

            <div align="center"><button type="submit" class="btn white" value="" style="margin: 10px;">GENERAR EXCEL</button></div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
  <script type="text/javascript" src="js/buscador.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#tabs").tabs();
    });
  </script>
</body>

</html>