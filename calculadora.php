
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Calculadora de Reforestación | A.P.A.</title>

    <link rel="stylesheet" href="calculadora.css">
</head>


<body>

<header>
        <h1>A.P.A.</h1>
        <nav>
            <a href="pagina principal.html">INICIO</a>
            <a href="pagina de la investigación.html">INVESTIGACIÓN</a>
            <a href="formulario.html">CONTÁCTANOS</a>
            <a href="calculadora.php">CALCULADORA DE REFORESTACIÓN</a>
            <a href="pagina color.html">pagina de teoria del</a>
        </nav>

        <h3>revisa nuestros trabajos en distintas materias</h3>
        <select name="materias" id="materias"
     onchange="if(this.value) window.location.href=this.value">

     <option value="">Selecciona una materia</option>
     <option value="pagina lenguaje.html">Español</option>
     <option value="pagina ingles.html">Inglés</option>
     <option value="pagina matematicas.html">Matemáticas</option>
     <option value="pagina educacion fisica.html">Educación física</option>
     </select>
   </header>
 



<div class="contenedor">

    <h1>Calculadora de Reforestación</h1>

    <p>
        Calcula los recursos necesarios para realizar un proyecto
        de reforestación considerando las características del terreno.
    </p>

    <form method="POST">

        <div class="seccion">
            <h2>1. Información del terreno</h2>

            <label>Área a reforestar (hectáreas):</label>
            <input type="number" name="area" min="0.01"
                   step="any" required>

            <label>Tipo de suelo:</label>
            <select name="suelo" required>
                <option value="">Selecciona el suelo</option>
                <option value="Arcilloso">Arcilloso</option>
                <option value="Arenoso">Arenoso</option>
                <option value="Limoso">Limoso</option>
                <option value="Franco">Franco</option>
                <option value="Pedregoso">Pedregoso</option>
            </select>

            <label>Fertilidad del suelo:</label>
            <select name="fertilidad" required>
                <option value="">Selecciona el nivel</option>
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
            </select>

            <label>Contenido de materia orgánica:</label>
            <select name="materia" required>
                <option value="">Selecciona el nivel</option>
                <option value="Bajo">Bajo</option>
                <option value="Medio">Medio</option>
                <option value="Alto">Alto</option>
            </select>
        </div>

        <div class="seccion">
            <h2>2. Disponibilidad de agua</h2>

            <label>Disponibilidad de agua en el terreno:</label>
            <select name="agua" required>
                <option value="">Selecciona una opción</option>
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
            </select>

            <label>Litros de agua por árbol cada semana:</label>
            <input type="number" name="litros"
                   min="0" step="any" value="5" required>

            <p class="nota">
                Este valor es una estimación editable.
                Debe ajustarse según la especie, clima,
                edad de la planta y humedad del suelo.
            </p>
        </div>

        <div class="seccion">
            <h2>3. Selección de árboles</h2>

            <label>Especie de árbol:</label>
            <select name="arbol" required>
                <option value="">Selecciona una especie</option>
                <option value="Aile">Aile (Alnus acuminata)</option>
                <option value="Pino">Pino</option>
                <option value="Encino">Encino</option>
                <option value="Ahuehuete">Ahuehuete</option>
                <option value="Otro">Otra especie</option>
            </select>

            <label>Distancia entre árboles (metros):</label>
            <input type="number" name="distancia"
                   min="0.5" step="any" value="3" required>

            <p class="nota">
                La separación debe adaptarse a la especie,
                el terreno y el objetivo de la plantación.
            </p>
        </div>

        <div class="seccion">
            <h2>4. Abono y fertilización</h2>

            <label>Tipo de abono:</label>
            <select name="abono" required>
                <option value="">Selecciona el abono</option>
                <option value="Composta">Composta orgánica</option>
                <option value="Humus">Humus de lombriz</option>
                <option value="Estiercol">Estiércol compostado</option>
                <option value="Ninguno">Sin abono adicional</option>
            </select>

            <label>Abono por árbol (kilogramos):</label>
            <input type="number" name="cantidad_abono"
                   min="0" step="any" value="1" required>
        </div>

        <button type="submit" name="calcular">
            Calcular plan de reforestación
        </button>

    </form>

    <?php

    if (isset($_POST['calcular'])) {

        $area = floatval($_POST['area']);
        $distancia = floatval($_POST['distancia']);
        $litros = floatval($_POST['litros']);
        $cantidad_abono = floatval($_POST['cantidad_abono']);

        $suelo = $_POST['suelo'];
        $fertilidad = $_POST['fertilidad'];
        $materia = $_POST['materia'];
        $agua = $_POST['agua'];
        $arbol = $_POST['arbol'];
        $abono = $_POST['abono'];

        if (
            $area > 0 &&
            $distancia > 0 &&
            $litros >= 0 &&
            $cantidad_abono >= 0
        ) {

            // Una hectárea equivale a 10,000 metros cuadrados.
            $metros = $area * 10000;

            // Cálculo de árboles según separación.
            $arboles = floor(
                $metros / ($distancia * $distancia)
            );

            // Agua estimada para una semana.
            $agua_semanal = $arboles * $litros;

            // Abono total estimado.
            $abono_total = $arboles * $cantidad_abono;

            // Recomendaciones según el suelo.
            $recomendaciones = [
                "Arcilloso" =>
                "Retiene bastante agua. Es importante evitar el encharcamiento y favorecer el drenaje.",

                "Arenoso" =>
                "Drena rápidamente. Se recomienda incorporar materia orgánica y vigilar la humedad.",

                "Limoso" =>
                "Suele retener humedad y nutrientes. Conviene mantener una buena estructura del suelo.",

                "Franco" =>
                "Generalmente presenta un equilibrio entre retención de agua y drenaje.",

                "Pedregoso" =>
                "Puede tener poca profundidad y dificultad para retener agua. Es importante evaluar el terreno."
            ];

            echo "<div class='resultado'>";

            echo "<h2>Resultados de la reforestación</h2>";

            echo "<p><strong>Área:</strong> $area hectáreas</p>";

            echo "<p><strong>Superficie:</strong> "
                . number_format($metros) . " m²</p>";

            echo "<p><strong>Tipo de suelo:</strong> $suelo</p>";

            echo "<p><strong>Árbol seleccionado:</strong> $arbol</p>";

            echo "<h3>Árboles necesarios</h3>";

            echo "<p><strong>"
                . number_format($arboles)
                . " árboles</strong></p>";

            echo "<h3>Recursos estimados</h3>";

            echo "<p><strong>Agua semanal:</strong> "
                . number_format($agua_semanal)
                . " litros</p>";

            echo "<p><strong>Abono necesario:</strong> "
                . number_format($abono_total, 2)
                . " kg</p>";

            echo "<p><strong>Tipo de abono:</strong> $abono</p>";

            echo "<h3>Evaluación del terreno</h3>";

            echo "<p><strong>Fertilidad:</strong> $fertilidad</p>";

            echo "<p><strong>Materia orgánica:</strong> $materia</p>";

            echo "<p><strong>Disponibilidad de agua:</strong> $agua</p>";

            echo "<p><strong>Recomendación:</strong> "
                . $recomendaciones[$suelo]
                . "</p>";

            echo "<p><strong>Separación:</strong> "
                . $distancia
                . " metros</p>";

            echo "</div>";

        } else {

            echo "<p>Por favor, introduce cantidades válidas.</p>";

        }
    }

    ?>

    <p class="nota">
        A.P.A. - Proyecto de investigación y reforestación.
        Los cálculos son estimaciones de planeación y no sustituyen
        un análisis de suelo ni una evaluación técnica del sitio.
    </p>

</div>

</body>
</html>
