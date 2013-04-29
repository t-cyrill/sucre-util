<?php
namespace Sucre\Logger;

use Sucre\CLI\ColorEscape;

/**
 * 色付きのログをstdoutに書き出すLogger
 */
class ColorizeStandardOutLogger extends StandardOutLogger
{
    private $color = null;

    public function warn($msg)
    {
        $this->setColor(ColorEscape::YELLOW);
        parent::warn($msg);
        $this->resetColor();
    }

    public function error($msg)
    {
        $this->setColor(ColorEscape::RED);
        parent::error($msg);
        $this->resetColor();
    }

    public function fatal($msg)
    {
        $this->setColor(ColorEscape::RED);
        parent::fatal($msg);
        $this->resetColor();
    }

    protected function write($log)
    {
        if ($this->color !== null) {
            parent::write($this->color);
        }

        parent::write($log);

        if ($this->color !== null) {
            parent::write(ColorEscape::NORMAL);
        }
    }

    private function setColor($color)
    {
        $this->color = $color;
    }

    private function resetColor()
    {
        $this->color = null;
    }
}

