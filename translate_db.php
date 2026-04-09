<?php
require_once 'config/database.php';

$titulos_translation = [
    'BU1032' => [
        'titulo' => 'La Guía de Bases de Datos del Ejecutivo Ocupado',
        'notas' => 'Una descripción general de los sistemas de bases de datos disponibles con énfasis en aplicaciones comerciales comunes. Ilustrado.'
    ],
    'BU1111' => [
        'titulo' => 'Cocinando con Computadoras: Balances Subrepticios',
        'notas' => 'Consejos útiles sobre cómo utilizar sus recursos electrónicos de la mejor manera.'
    ],
    'BU2075' => [
        'titulo' => '¡Puedes Combatir el Estrés Informático!',
        'notas' => 'Las últimas técnicas médicas y psicológicas para convivir con la oficina electrónica. Explicaciones fáciles de entender.'
    ],
    'BU7832' => [
        'titulo' => 'Hablando Claro Sobre Computadoras',
        'notas' => 'Análisis comentado de lo que las computadoras pueden hacer por ti: una guía sin exageraciones para el usuario crítico.'
    ],
    'MC2222' => [
        'titulo' => 'Delicias Gastronómicas de Silicon Valley',
        'notas' => 'Recetas favoritas para comidas rápidas, fáciles y elegantes, probadas por personas que nunca tienen tiempo para comer, y mucho menos para cocinar.'
    ],
    'MC3021' => [
        'titulo' => 'El Microondas Gourmet',
        'notas' => 'Recetas tradicionales gourmet francesas adaptadas para la cocina moderna en microondas.'
    ],
    'MC3026' => [
        'titulo' => 'La Psicología de Cocinar con Computadoras',
        'notas' => ''
    ],
    'PC1035' => [
        'titulo' => '¿Pero es Fácil de Usar?',
        'notas' => 'Una encuesta de software para el usuario novato, enfocándose en la "facilidad de uso" de cada uno.'
    ],
    'PC8888' => [
        'titulo' => 'Secretos de Silicon Valley',
        'notas' => 'Reportaje de investigación realizado por dos mujeres valientes sobre los principales fabricantes de hardware y software del mundo.'
    ],
    'PC9999' => [
        'titulo' => 'Etiqueta en la Red',
        'notas' => '¡Una lectura obligada para debutantes de teleconferencias en computadora!'
    ],
    'PS1372' => [
        'titulo' => 'Individuos Fóbicos y No Fóbicos a las Computadoras: Variación',
        'notas' => 'Esencial para el especialista, este libro examina la diferencia entre los que odian y temen a las computadoras y los que piensan que son geniales.'
    ],
    'PS2091' => [
        'titulo' => '¿Es la Ira el Enemigo?',
        'notas' => 'Estudio cuidadosamente investigado sobre los efectos de las emociones fuertes en el cuerpo. Incluye gráficas metabólicas.'
    ],
    'PS2106' => [
        'titulo' => 'La Vida Sin Miedo',
        'notas' => 'Nuevas técnicas de ejercicio, meditación y nutrición que pueden reducir el impacto de las interacciones diarias. Público general. Incluye menús de muestra, video de ejercicios disponible.'
    ],
    'PS3333' => [
        'titulo' => 'Privación Prolongada de Datos: Cuatro Casos de Estudio',
        'notas' => '¿Qué ocurre cuando se agotan los datos? Evaluaciones profundas de los efectos de la falta de información en usuarios intensivos.'
    ],
    'PS7777' => [
        'titulo' => 'Seguridad Emocional: Un Nuevo Algoritmo',
        'notas' => 'Protégase y a sus seres queridos del estrés emocional innecesario en el mudo moderno. Enfatiza el uso de la computadora y complementos nutricionales.'
    ],
    'TC3218' => [
        'titulo' => 'Cebollas, Puerros y Ajo: Secretos de Cocina del Mediterráneo',
        'notas' => 'Profusamente ilustrado a color, es un libro de regalo maravilloso para un amigo aficionado a la cocina.'
    ],
    'TC4203' => [
        'titulo' => 'Cincuenta Años en las Cocinas del Palacio de Buckingham',
        'notas' => 'Más anécdotas del cocinero favorito de la Reina describiendo la vida en la realeza inglesa. Recetas, técnicas y tiernas viñetas.'
    ],
    'TC7777' => [
        'titulo' => '¿Alguien Quiere Sushi?',
        'notas' => 'Instrucciones detalladas sobre cómo hacer auténtico sushi japonés en tu tiempo libre. Reporta un aumento del 5-10% en amigos en la fase beta.'
    ]
];

$biografias_translation = [
    '486-29-1786' => '¡Si Chastity Locksley no existiera, este mundo turbulento la habría inventado! No solo dominó los secretos místicos de la fuerza interior para conquistar la adversidad en la vida, sino que se "reinventó" a sí misma.',
    '648-92-1872' => 'El chef de los chefs y el narrador por excelencia. Su capacidad asombrosa para deleitar nuestros paladares se iguala sólo por su gran destreza.',
    '998-72-3567' => 'Albert Ringer nació en un baúl, hijo de padres de circo, y creció como un trotamundos entre luchadores en el renombrado Circo Ringer Brothers.',
    '899-46-2035' => 'Anne Ringer se escapó del circo cuando era niña. Un profesor universitario la acogió con su familia, donde aprendió a apreciar los grandes clásicos.',
    '672-71-3249' => 'Me pidieron que escribiera sobre mí y mi libro, así que allá va: empecé un restaurante llamado "de Gustibus" con dos amigos.',
    '409-56-7008' => 'Bennet era el clásico ejecutivo demasiado ocupado. Tras descubrir las bases de datos informáticas, ahora tiene tiempo para administrar varias empresas de éxito.'
];

try {
    $pdo->beginTransaction();

    $stmt_titulos = $pdo->prepare("UPDATE titulos SET titulo = :titulo, notas = :notas WHERE id_titulo = :id");
    foreach ($titulos_translation as $id_titulo => $data) {
        $stmt_titulos->execute([
            ':titulo' => $data['titulo'],
            ':notas' => $data['notas'],
            ':id' => $id_titulo
        ]);
    }

    $stmt_bio = $pdo->prepare("UPDATE biografias SET biografia = :biografia WHERE id_autor = :id");
    foreach ($biografias_translation as $id_autor => $biografia) {
        $stmt_bio->execute([
            ':biografia' => $biografia,
            ':id' => $id_autor
        ]);
    }

    $pdo->commit();
    echo "¡Traducción de la base de datos completada exitosamente!\n";
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Error traduciendo la base de datos: " . $e->getMessage() . "\n";
}
