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
        $html = $this->twig->render('index.html.twig', array(
            'title'     => $this->specification->getTitle(),
            'base_url'  => $this->specification->getBaseUrl(),
            'security'  => $this->specification->getSecuritySchemes(),
            'resources' => $this->specification->getResources(),
            'documentation' => $this->specification->getDocumentationList(),
        ));

        file_put_contents($output, $html);
    }
}
