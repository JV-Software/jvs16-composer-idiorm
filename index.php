<?php
require_once 'vendor/autoload.php';

// 1. Configuracion base de datos
ORM::configure('mysql:host=localhost;dbname=jvs_tutoriales');
ORM::configure('username', 'root');
ORM::configure('password', '');

// 2. Configuracion de clave primaria (si el nombre no es 'id')
/*ORM::configure('id_column_overrides', array(
    'city' => 'id_city'
));*/

// 3. SELECT * FROM city
$ciudades = ORM::for_table('city')->find_many();
/*foreach ($ciudades as $ciudad) {
    echo $ciudad->Name . "<br>";
}*/

// 4. SELECT * FROM city WHERE `ID` = `5`
$ciudad = ORM::for_table('city')->find_one(5);
// echo $ciudad->Name;

// 5. SELECT * FROM city WHERE `Population` >= 500000
$ciudadesPoblacion = ORM::for_table('city')
                        ->where_gt('Population', 500000)
                        ->find_many();
/*foreach ($ciudadesPoblacion as $ciudad) {
    echo $ciudad->Name . ", Poblacion: " . $ciudad->Population . "<br>";
}*/

// 6. SELECT * FROM city WHERE `Population` >= 500000 AND `Name` LIKE `N%`
$ciudadesNombre = ORM::for_table('city')
                    ->where_gt('Population', 500000)
                    ->where_like('Name', 'N%')
                    ->find_many();
/*foreach ($ciudadesNombre as $ciudad) {
    echo $ciudad->Name . "<br>";
}*/

// 7. SELECT * FROM city WHERE `Name` LIKE `A%` OR `Name` LIKE `B%` ORDER BY `Name`
$ciudadesOr = ORM::for_table('city')
                ->where_raw('(`Name` LIKE ? OR `Name` LIKE ?)', array('A%', 'B%'))
                ->order_by_asc('Name')
                ->find_many();
/*foreach ($ciudadesOr as $ciudad) {
    echo $ciudad->Name . "<br>";
}*/

// 8. SELECT AVG(`Population`) FROM `city`
$ciudadesProm = ORM::for_table('city')
                    ->avg('Population');
// echo $ciudadesProm;