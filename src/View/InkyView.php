<?php

namespace Burzum\ZurbInky\View;

use Cake\View\View;
use Pelago\Emogrifier;
use Pinky;

class InkyView extends View
{

    /**
     * @inheritDoc
     */
    public function render($view = null, $layout = null)
    {
        $output = parent::render($view, $layout);
        $output = Pinky\transformString($output)->saveHTML();

        $emogrifier = new Emogrifier();
        $emogrifier->setHtml($output);
        //$emogrifier->setCss();

        return $emogrifier->emogrify();
    }
}
