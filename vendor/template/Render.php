<?php

namespace Gifts\Template;

class Render
{

    protected $templateDir;

    protected $ext = '.php';

    public function __construct()
    {
        $this->templateDir = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR;
    }

    function render($templateName, $parameters)
    {
        ob_start();
        if (is_array($parameters)) {
            extract($parameters);
        }
        include $this->templateDir.$templateName.$this->ext;

        return ob_get_clean();
    }

}