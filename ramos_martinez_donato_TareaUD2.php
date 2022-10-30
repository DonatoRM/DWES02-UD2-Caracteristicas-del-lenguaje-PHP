<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="Content-Type" content="text/html, charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="application-name" content="Tarea DWES02" />
    <meta name="description" content="Agenda en una única página Web programada en PHP" />
    <meta name="keywords" content="html,css,php" />
    <meta name="author" content="Donato Ramos Martínez" />
    <title>Tarea Unidad 2</title>
    <link rel="icon" href="./images/php.png" type="image/png" sizes="16x16" />
    <link rel="stylesheet" type="text/css" href="./css/ramos_martinez_donato_TareaUD2.css" media="screen" />
  </head>
  <body>
    <?php $diary = []; ?>
    <header>
      <h1>Agenda</h1>
    </header>
    <main>
      <section>
        <?php if (!empty($diary)) {
          echo "<form name=\"agendaDataForm\">";
          echo "<fieldset>";
          echo "<legend>Datos Agenda</legend>";
          // Datos de PHP
          echo "</fieldset>";
          echo "</form>";
        } ?>
    </section>
      <section>
        <form name="formNewContact" method="get" action="<?php $_SERVER["PHP_SELF"]; ?>" target="_self">
          <fieldset>
            <legend>Nuevo Contacto</legend>
            <p>
              <label class="blueColor" for="idName" tabindex="1">Nombre:</label>
              <input type="text" name="name" id="idName" autofocus />
            </p>
            <p>
              <label class="blueColor" for="idPhone" tabindex="2">Teléfono:</label>
              <input type="text" name="phone" id="idPhone" />
            </p>
            <p>
              <input class="blueColor" type="submit" name="add" value="Añadir Contacto" />
              <input class="greenColor" type="reset" name="reset" value="Limpiar Campos" />
            </p>
          </fieldset>
        </form>
      </section>
      <section>
        <?php if (!empty($diary)) {
          echo "<form name=\"agendaDataForm\">";
          echo "<fieldset>";
          echo "<legend>Datos Agenda</legend>";
          // Datos de PHP
          echo "</fieldset>";
          echo "</form>";
        } ?>
      </section>
    </main>
  </body>
</html>
