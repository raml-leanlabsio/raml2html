<?php

namespace Cnam\Twig;

use Twig_Extension;
use Twig_SimpleFilter;

class Extension extends  Twig_Extension
{

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'cnam';
    }

    public function getFilters()
    {
        return [
            'readable_json' => new Twig_SimpleFilter('readable_json', array($this, 'readable_json')),
            'generate_name' => new Twig_SimpleFilter('generate_name', array($this, 'generate_name'))
        ];
    }

    public function getFunctions()
    {
        return [
            'file_loader' => new \Twig_SimpleFunction('file_loader', array($this, 'file_loader'))
        ];
    }

    public function readable_json($in, $indent = 0)
    {
        if (is_object($in)) {
            $in = (string) $in;
            $in = json_decode($in, true);
        }

        $_escape = function ($str){
            return preg_replace("!([\b\t\n\r\f\"\\'])!", "\\\\\\1", $str);
        };

        $out = '';

        foreach ($in as $key=>$value)
        {
            $out .= str_repeat("    ", $indent + 1);
            $out .= "\"".$_escape((string)$key)."\": ";

            if (is_object($value) || is_array($value))
            {
                $out .= "\n";
                $out .= $this->readable_json($value, $indent + 1);
            }
            elseif (is_bool($value))
            {
                $out .= $value ? 'true' : 'false';
            }
            elseif (is_null($value))
            {
                $out .= 'null';
            }
            elseif (is_string($value))
            {
                $out .= "\"" . $_escape($value) ."\"";
            }
            else
            {
                $out .= $value;
            }

            $out .= ",\n";
        }

        if (!empty($out))
        {
            $out = substr($out, 0, -2);
        }

        $out = str_repeat("    ", $indent) . "{\n" . $out;
        $out .= "\n" . str_repeat("    ", $indent) . "}";

        return $out;
    }

    public function file_loader($name)
    {
        if (file_exists($name)) {
            return file_get_contents($name);
        }

        return $name;
    }

    public function generate_name($name)
    {
        return preg_replace('/\//', ' ', $name);
    }
}
