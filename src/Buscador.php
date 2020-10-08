<?php

namespace Antonio\BuscadorCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{

    /**
     * @var ClientInterface
     */
    private ClientInterface $httpClient;
    /**
     * @var Crawler
     */
    private Crawler $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url)
    {
        // obtenemos el HTML completo de la pagina
        $respuesta = $this->httpClient->request('GET', $url);

        $html = $respuesta->getBody();

        $this->crawler->addHtmlContent($html); // en el constructor tambien podemos meter el html

        $dom = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];
        foreach ($dom as $domElement) {
            $cursos[] = $domElement->textContent;
        }
        return $cursos;
    }
}
