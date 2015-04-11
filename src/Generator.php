<?php

namespace Cnam;

use Cnam\Raml\SecurityScheme\JwtSecurityParser;
use Cnam\Twig\Extension;
use Raml\Parser;
use Raml\Response;
use Raml\SecurityScheme;
use Raml\SecurityScheme\SecuritySettingsParser\OAuth1SecuritySettingsParser;
use Raml\SecurityScheme\SecuritySettingsParser\OAuth2SecuritySettingsParser;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Generator
{

    /**
     * @var \Raml\ApiDefinition
     */
    private $specification;

    /**
     * @var Parser
     */
    private $parser;

    public function __construct()
    {
        $this->parser = new Parser(null, [
            new OAuth1SecuritySettingsParser(),
            new OAuth2SecuritySettingsParser(),
            new JwtSecurityParser()

        ]);
        $loader = new Twig_Loader_Filesystem(__DIR__.'/Resources/view');
        $this->twig = new Twig_Environment($loader, ['debug' => true]);
        $this->twig->addExtension(new Extension());
    }

    /**
     * @param string $input file from generate
     */
    public function parse($input)
    {
        $this->specification = $this->parser->parse($input, true);
    }

    /**
     * @param string $output file to generate
     */
    public function generate($output)
    {
        $security = [];

        /**
         * @var $resource \Raml\Resource
         */
        foreach ($this->specification->getResources() as $resource) {
            $resource->getUri();
            /**
             * @var $method \Raml\Method
             */
            $methods =  $resource->getMethods();
            foreach ($methods as $method) {
                $method->getType();
                //var_dump($method->getHeaders());
                /**
                 * @var $response Response
                 */
                foreach ($method->getResponses() as $response)
                {
                    /*var_dump($response->getStatusCode());
                    die();*/
                    //var_dump($response->getTypes());
                    /**
                     * @var $body \Raml\Body
                     */
                    //$body = $response->getBodyByType('application/json');
                    //$body->getSchema();
                    //$response->getBodyByType();
                }


                /*foreach($method->getSecuritySchemes() as  $security){
                    $security[$security->getType()] = $security;
                }*/
            }
        }


        $html = $this->twig->render('index.html.twig', array(
            'title'     => $this->specification->getTitle(),
            'base_url'  => $this->specification->getBaseUrl(),
            'security'  => $this->specification->getSecuritySchemes(),
            'resources' => $this->specification->getResources(),
        ));

        file_put_contents($output, $html);
    }
}
