<?php
class ConcertView {

    public function showConcerts($concerts) {
        require_once __DIR__ . '/templates/layout/header.phtml';
        echo "<h2>Listado de conciertos</h2>";
        foreach ($concerts as $concert) {
            echo "<h3><a href='" . BASE_URL . "concierto/" . $concert->id_concierto . "'>" . htmlspecialchars($concert->lugar) . "</a></h3>";
            echo "<p>Fecha: " . htmlspecialchars($concert->fecha) . "</p>";
            echo "<p>Banda: " . htmlspecialchars($concert->banda_nombre) . "</p>";
            echo "<hr>";
        }
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }

    public function showConcertDetail($concert) {
        require_once __DIR__ . '/templates/layout/header.phtml';
        echo "<h2>Detalle del concierto</h2>";
        if ($concert) {
            echo "<h3>" . htmlspecialchars($concert->lugar) . "</h3>";
            echo "<p>Ciudad: " . htmlspecialchars($concert->ciudad) . "</p>";
            echo "<p>Fecha: " . htmlspecialchars($concert->fecha) . "</p>";
            echo "<p>Banda: " . htmlspecialchars($concert->banda_nombre) . "</p>";
            echo "<p>Precio Platea: $" . htmlspecialchars($concert->precio_platea) . "</p>";
            echo "<p>Precio Campo: $" . htmlspecialchars($concert->precio_campo) . "</p>";
            echo "<p>Precio Popular: $" . htmlspecialchars($concert->precio_popular) . "</p>";
        } else {
            echo "<p>Concierto no encontrado</p>";
        }
        echo "<p><a href='" . BASE_URL . "conciertos'>Volver al listado</a></p>";
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }

    public function showAdminPanel($concerts, $bandas) {
        require_once __DIR__ . '/templates/layout/header.phtml';
        echo "<h2>Panel de Administración - Conciertos</h2>";
        
        // Formulario de Alta
        echo "<h3>Agregar Nuevo Concierto</h3>";
        echo "<form action='" . BASE_URL . "agregar-concierto' method='POST'>
            <input type='date' name='fecha' required>
            <input type='text' name='lugar' placeholder='Lugar' required>
            <input type='text' name='ciudad' placeholder='Ciudad' required>
            <input type='number' name='precio_platea' placeholder='Precio Platea' required>
            <input type='number' name='precio_campo' placeholder='Precio Campo' required>
            <input type='number' name='precio_popular' placeholder='Precio Popular' required>
            <label>Banda: </label>
            <select name='id_banda' required>";
            foreach ($bandas as $banda) {
                echo "<option value='{$banda->id_banda}'>{$banda->nombre}</option>";
            }
        echo "</select>
            <button type='submit'>Guardar</button>
        </form><hr>";

        // Tabla de gestión ABM
        echo "<h3>Lista de Conciertos Activos</h3><table border='1'><tr><th>Lugar</th><th>Banda</th><th>Acciones</th></tr>";
        foreach ($concerts as $c) {
            echo "<tr>
                <td>" . htmlspecialchars($c->lugar) . "</td>
                <td>" . htmlspecialchars($c->banda_nombre) . "</td>
                <td>
                    <a href='" . BASE_URL . "editar-concierto/{$c->id_concierto}'>Editar</a> | 
                    <a href='" . BASE_URL . "eliminar-concierto/{$c->id_concierto}'>Eliminar</a>
                </td>
            </tr>";
        }
        echo "</table>";
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }

    public function showEditForm($concert, $bandas) {
        require_once __DIR__ . '/templates/layout/header.phtml';
        echo "<h2>Editar Concierto</h2>";
        echo "<form action='" . BASE_URL . "editar-concierto/{$concert->id_concierto}' method='POST'>
            <input type='date' name='fecha' value='{$concert->fecha}' required>
            <input type='text' name='lugar' value='".htmlspecialchars($concert->lugar)."' required>
            <input type='text' name='ciudad' value='".htmlspecialchars($concert->ciudad)."' required>
            <input type='number' name='precio_platea' value='{$concert->precio_platea}' required>
            <input type='number' name='precio_campo' value='{$concert->precio_campo}' required>
            <input type='number' name='precio_popular' value='{$concert->precio_popular}' required>
            <select name='id_banda' required>";
            foreach ($bandas as $banda) {
                $selected = ($banda->id_banda == $concert->id_banda) ? 'selected' : '';
                echo "<option value='{$banda->id_banda}' {$selected}>{$banda->nombre}</option>";
            }
        echo "</select>
            <button type='submit'>Modificar</button>
        </form>";
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }
}
