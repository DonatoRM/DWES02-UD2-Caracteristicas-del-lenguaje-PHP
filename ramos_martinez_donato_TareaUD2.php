<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="Content-Type" content="text/html, charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="application-name" content="Tarea Para DWES02" />
    <meta name="description" content="Tarea para MP0613. Desenvolvemento web en contorno servidor" />
    <meta name="keywords" content="html,css,php" />
    <meta name="author" content="Donato Ramos Martínez" />
    <title>Tarea Unidad 2</title>
    <link rel="icon" href="./images/php.png" type="image/png" sizes="16x16" />
    <link rel="stylesheet" type="text/css" href="./css/ramos_martinez_donato_TareaUD2.css" media="screen" />
  </head>
  <?php
  if (isset($_GET["limpiar"])) {
    unset($phoneBook);
  }
  if (!isset($_POST["phoneBook"])) {
    $phoneBook = [];
  } else {
    $phoneBook = $_POST["phoneBook"];
  }
  ?>
  <body>
    <?php if (isset($_POST["add"])) {
      if (isset($_POST["name"])) {
        $name = trim($_POST["name"]);
        if (empty($name)) {
          echo "<p class=\"error\">El nombre es obligatorio!!!</p>";
        }
        unset($name);
      }
    } ?>
    <header>
      <h1>Agenda</h1>
    </header>
    <main>
      <section>
        <?php
        if (isset($_POST["add"])) {
          if (isset($_POST["name"])) {
            $name = trim(strtoupper($_POST["name"]));
            if (!empty($name)) {
              if (isset($_POST["phone"])) {
                $phone = trim($_POST["phone"]);
                if (!empty($phone)) {
                  // !Se guarda registro
                  $phoneBook[$name] = $phone;
                  ksort($phoneBook, 3);
                } else {
                  // !Se borra registro
                  if (array_key_exists($name, $phoneBook)) {
                    unset($phoneBook[$name]);
                  }
                }
              }
            } else {
              unset($name);
            }
          }
        }
        if (isset($phoneBook)) {
          if (!empty($phoneBook)) {
            echo "<form name=\"phoneBookDataForm\">";
            echo "<fieldset>";
            echo "<legend>Datos Agenda</legend>";
            echo "<ul>";
            foreach ($phoneBook as $key => $value) {
              print "<li><span class=\"key\">$key</span><span class=\"value\">$value</span></li>";
            }
            echo "</ul>";
            echo "</fieldset>";
            echo "</form>";
          }
        }
        ?>
      </section>
      <section>
        <form name="formNewContact" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>" target="_self">
          <fieldset>
            <legend>Nuevo Contacto</legend>
            <p>
              <label class="blueColor" for="idName" tabindex="1">Nombre:</label>
              <input type="text" name="name" id="idName" autofocus />
            </p>
            <p>
              <label class="blueColor" for="idPhone" min="9" max="13" step="1" tabindex="2">Teléfono:</label>
              <input type="text" name="phone" id="idPhone" />
            </p>
            <?php foreach ($phoneBook as $key => $value) {
              echo "<input type='hidden' name='phoneBook[$key]' value='$value' />";
            } ?>
            <p>
              <input class="blueColor" type="submit" name="add" value="Añadir Contacto" />
              <input class="greenColor" type="reset" name="reset" value="Limpiar Campos" />
            </p>
          </fieldset>
        </form>
      </section>
      <section>
      <?php if (!empty($phoneBook)) {
        echo "<form name=\"phoneBookDataForm\" method=\"get\" action=\"" . $_SERVER["PHP_SELF"] . "\" target=\"_self\">";
        echo "<fieldset>";
        echo "<legend>Vaciar Agenda</legend>";
        echo "<button type=\"submit\" class=\"pinkColor\" name=\"limpiar\" value=\"1\">Vaciar</button>";
        echo "</fieldset>";
        echo "</form>";
      } ?>
      </section>
    </main>
  </body>
</html>
