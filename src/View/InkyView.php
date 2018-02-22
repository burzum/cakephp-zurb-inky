<?php
namespace Burzum\ZurbInky\View;

use Cake\View\View;
use Pelago\Emogrifier;
use Pinky;

class InkyView extends View
{
    public function renderLayout($content, $layout = null)
    {
        $layout = parent::renderLayout($content, $layout);
        $layout = Pinky\transformString($layout)->saveHTML();

        $emogrifier = new Emogrifier();
        $emogrifier->setHtml($layout);
        //$emogrifier->setCss();
        return $emogrifier->emogrify();
    }
}
