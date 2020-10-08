#!/usr/bin/env php
<?php
// Para usar las librerias de Composer necesitamos requerir
// el autoload de composer que hace carga automatica de todo
require 'vendor/autoload.php';

// FALTA AÑADIR nuestra clase para que funcione. Composer ayuda en este tema
// Cuanod añadimos PSR-4 en composer.json no es mas necesario hacer require
//require 'src/Buscador.php';

// Si no podemos usar composer para cargar una clase o fichero estilo antiguo
// podemos hacer autoload con classmap
// Ver composer.json para ver como Funciones sin namespace se añade
// Si Funciones tiene varias clases tambien se lo hace
echo Funciones::hoy() . PHP_EOL;
// Si no es una clase sino un fichero usamos file
// composer lo meterea en venddor/composer/autoload_files
echo variado();

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

//$cliente = new Client();
// Tambien se puede configurar BASE_URI
$cliente = new Client(['base_uri' => 'https://alura.com.br']);
$url = '/cursos-online-programacao/php';
//$respuesta = $cliente->request('GET', $url);

/*
// obtenemos el HTML completo de la pagina
$html = $respuesta->getBody();

$crawler = new Crawler();
$crawler->addHtmlContent($html); // en el constructor tambien podemos meter el html

$cursos = $crawler->filter('span.card-curso__nome');
*/
$crawler = new Crawler();

$buscador = new Antonio\BuscadorCursos\Buscador($cliente, $crawler);
$cursos = $buscador->buscar($url);
foreach ($cursos as $curso) {
    echo $curso . PHP_EOL;
}
