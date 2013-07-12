<?php
namespace Sucre\CLI;

class HelpMessageBuilder extends \Sucre\SucreObject {
    private $header = "OPTIONS:\n";
    private $descriptions = array();
    private $root_indent = 4;
    private $sub_indent = 4;

    public function setOptionHeader($string)
    {
        $this->header = $string;

        return $this;
    }

    public function setDescriptions(array $descriptions)
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    public function setRootIndent($indent)
    {
        $this->root_indent = $indent;

        return $this;
    }

    public function setSubIndent($indent)
    {
        $this->sub_indent = $indent;

        return $this;
    }

    public function getMessage()
    {
        $sub_indent = $this->sub_indent;
        $root_indent = $this->root_indent;
        $descriptions = $this->descriptions;

        uksort($descriptions, function ($a, $b) {
            $a = preg_replace('/\A\\-+/', '', $a);
            $b = preg_replace('/\A\\-+/', '', $b);
            return strcasecmp($a, $b);
        });

        $message = $this->header;
        foreach ($descriptions as $option => $desc) {
            $message .= str_repeat(' ', $root_indent);
            $message .= $option.PHP_EOL;
            $message .= str_repeat(' ', $root_indent + $sub_indent);
            $message .= $desc.PHP_EOL.PHP_EOL;
        }

        return $message;
    }
}

