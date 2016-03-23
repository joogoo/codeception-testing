<?php

namespace CodeceptionTesting;

use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;
use const TEMPLATE_PATH;

class View {
    protected $template = null;
    protected $templateName = null;

    public function __construct($templateName = null)
    {
        $this->templateName = $templateName . '.twig';
        $loader = new Twig_Loader_Filesystem(TEMPLATE_PATH . '/');
        $twig = new Twig_Environment($loader, array(
                'debug' => true,
            )
        );
        $twig->addExtension(new Twig_Extension_Debug());
        $this->template = $twig->loadTemplate($this->templateName);
    }
    
    public function parse($array = null)
    {
        return $this->template->render(
            array_merge(
                array_filter((new Session())->extract()),
                $array
            )
        );
    }
}
