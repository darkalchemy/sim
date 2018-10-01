<?php
namespace App\Extensions;

use Illuminate\Translation\Translator;

/**
 * Classe utilisant Illuminate Translator dans twig (Don't touch)
 */
class TranslatorExtension extends \Twig_Extension
{
    /**
     * @var Translator
     */
    private $translator;
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }
    public function getName()
    {
        return 'slim_translator';
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('trans', [$this->translator, 'trans']),
            new \Twig_SimpleFunction('transChoice', [$this->translator, 'transChoice']),
        ];
    }
}
