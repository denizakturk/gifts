<?php

namespace Gifts\Template;

class Render
{

    protected $templateDir;

    protected $ext = '.php';

    public $templateName = 'base';

    public function __construct()
    {
        $this->templateDir = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR;
    }

    public function viewExists($viewPath)
    {
        return file_exists($this->templateDir.$viewPath.$this->ext);
    }

    public function render($viewPath, $parameters)
    {
        if ($this->viewExists($viewPath)) {
            ob_start();
            if (is_array($parameters)) {
                extract($parameters);
            }

            include $this->templateDir.$viewPath.$this->ext;

            return ob_get_clean();
        }

        return null;
    }

}