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
  /*
  La función 'eliminatePhoneBook()' elimina los datos de la agenda 'phoneBook' cuando se pulsa el botón 'Vaciar' del
  formulario 'phoneBookDataForm'
  */
  function eliminatePhoneBook()
  {
    global $phoneBook;
    if (isset($_GET["limpiar"])) {
      unset($phoneBook);
    }
  }
  /*
  La función 'initializePhoneBook()' se ejecuta en el comienzo de la aplicación y después de que se borren los datos
  de la agenda 'phoneBook' y, su misión es inicializar la agenda
  */
  function initializePhoneBook()
  {
    global $phoneBook;
    if (!isset($_POST["phoneBook"])) {
      $phoneBook = [];
    } else {
      $phoneBook = $_POST["phoneBook"];
    }
  }
  /*
  La función 'nameFieldCheck()' comprueba que, al pulsar el botón 'Añadir Contacto' del formulario 'formNewContact'
  si el campo 'name' está vacío, nos mostrará un mensaje de advertencia en la parte superior izquierda de la
  aplicación
  */
  function nameFieldCheck()
  {
    if (isset($_POST["add"])) {
      if (isset($_POST["name"])) {
        $name = trim($_POST["name"]);
        if (empty($name)) {
          echo "<p class=\"error\">El nombre es obligatorio!!!</p>";
        }
      }
    }
  }
  /*
  La función 'createPhoneBookDataForm()' crea el formulario 'phoneBookDataForm' si existen datos dentro de la
  agenda 'phoneBook'
  */
  function createPhoneBookDataForm()
  {
    global $phoneBook;
    if (isset($phoneBook)) {
      if (!empty($phoneBook)) {
        echo "<form name=\"phoneBookDataForm\">";
        echo "<fieldset>";
        echo "<legend>Datos Agenda</legend>";
        echo "<ul>";
        foreach ($phoneBook as $key => $value) {
          print "<li><div class=\"key blueColor\">$key</div><div class=\"value blueColor\">$value</div></li>";
        }
        echo "</ul>";
        echo "</fieldset>";
        echo "</form>";
      }
    }
  }
  /*
  La función 'createEmptyPhoneBookForm()' crea el formulario 'createEmptyPhoneBookForm' cuando existen datos
  dentro de la agenda 'phoneBook'
  */
  function createEmptyPhoneBookForm()
  {
    global $phoneBook;
    if (!empty($phoneBook)) {
      echo "<form name=\"createEmptyPhoneBookForm\" method=\"get\" action=\"" .
        $_SERVER["PHP_SELF"] .
        "\" target=\"_self\">";
      echo "<fieldset>";
      echo "<legend>Vaciar Agenda</legend>";
      echo "<button type=\"submit\" class=\"pinkColor emptyButton\" name=\"limpiar\" value=\"1\">Vaciar</button>";
      echo "</fieldset>";
      echo "</form>";
    }
  }
  /*
  La función 'performActionsInPhoneBook()' es la función que lleva el control de la inserción, borrado, 
  actualización y ordenado de los registros dentro de la agenda 'phoneBook' siempre que se pulse el
  botón 'Añadir Contacto' del formulario 'formNewContact'
  */
  function performActionsInPhoneBook()
  {
    global $phoneBook;
    if (isset($_POST["add"])) {
      if (isset($_POST["name"])) {
        $name = trim(strtoupper($_POST["name"]));
        if (!empty($name)) {
          if (isset($_POST["phone"])) {
            $phone = trim($_POST["phone"]);
            if (!empty($phone)) {
              /* Si tenemos 'name' y 'phone' se guarda registro en la agenda 'phoneBook' y se ordena por
               su clave, ya que 'phoneBook' es un array asociativo */
              $phoneBook[$name] = $phone;
              ksort($phoneBook, 3);
            } else {
              /* Si tenemos 'name' y 'phone' está vacío, si existe 'name' dentro de la agenda 'phoneBook'
               lo elimina */
              if (array_key_exists($name, $phoneBook)) {
                unset($phoneBook[$name]);
              }
            }
          }
        }
      }
    }
  }
  ?>
  <body>
    <?php
    eliminatePhoneBook();
    initializePhoneBook();
    nameFieldCheck();
    ?>
    <header>
      <h1>Agenda</h1>
    </header>
    <main>
      <section>
        <?php
        performActionsInPhoneBook();
        createPhoneBookDataForm();
        ?>
      </section>
      <section>
        <!-- Creación del formulario 'formNewContact' -->
        <form name="formNewContact" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>" target="_self">
          <fieldset>
            <legend>Nuevo Contacto</legend>
            <p id="fileName">
              <label class="blueColor" id="lblName" for="idName" tabindex="1">Nombre:</label>
              <input type="text" name="name" id="idName" autofocus />
            </p>
            <p id="filePhone">
              <label class="blueColor" id="lblPhone" for="idPhone" tabindex="2">Teléfono:</label>
              <input type="text" name="phone" id="idPhone" />
            </p>
              <!-- Dentro del formulario 'formNewContact' insertamos un bucle 'foreach()' en cuyo interior
              situamos un control 'input:hidden' para, conseguir con esto que almacene en la URL de 
              nuestra aplicación los datos del array '$phoneBook' (tanto sus claves como sus valores) -->
              <?php foreach ($phoneBook as $key => $value) {
                echo "<input type='hidden' name='phoneBook[$key]' value='$value' />";
              } ?>
            <p>
              <input class="blueColor buttonSize" type="submit" name="add" value="Añadir Contacto" />
              <input class="greenColor buttonSize" type="reset" name="reset" value="Limpiar Campos" />
            </p>
          </fieldset>
        </form>
      </section>
      <section>
      <?php createEmptyPhoneBookForm(); ?>
      </section>
    </main>
  </body>
</html>
