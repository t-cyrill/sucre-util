<?php
namespace Sucre\CLI;

use Closure;

class OptionParser extends \Sucre\SucreObject {
    private $callbacks = [];
    private $longOptions = [];
    private $shortOptions = [];

    public function parse()
    {
        $results = array();

        $options = getopt(implode($this->shortOptions), $this->longOptions);

        $set_options = array_merge($this->shortOptions, $this->longOptions);
        foreach ($set_options as $set_option) {
            $opt = explode(':', $set_option);

            if (isset($options[$opt[0]])) {
                if (is_bool($options[$opt[0]])) {
                    $params = [$options[$opt[0]]];
                } else {
                    $params = $options[$opt[0]];
                }

                $result = $this->callbacks[$set_option]($params);
                $results = array_merge($results, $result);
            }
        }

        return $results;
    }

    public function addRule($option, Closure $callback) {
        $opt = explode(':', $option);

        if (strlen($opt[0]) === 1) {
            $this->shortOptions[] = $option;
        } else {
            $this->longOptions[] = $option;
        }

        $this->callbacks[$option] = $callback;

        return $this;
    }

    public function addRules(array $options, Closure $callback) {
        foreach ($options as $option) {
            $this->addRule($option, $callback);
        }

        return $this;
    }

}

