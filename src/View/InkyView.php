<?php
declare(strict_types = 1);

namespace Burzum\ZurbInky\View;

use Cake\View\View;
use Pelago\Emogrifier;
use Pinky;
use RuntimeException;

/**
 * InkyView
 *
 * @link https://github.com/zurb/inky
 * @link https://github.com/lorenzo/pinky
 * @link https://github.com/MyIntervals/emogrifier
 */
class InkyView extends View
{
    /**
     * CSS
     *
     * @var array
     */
    protected $_css;

    /**
     * Emogrifier CSS Parser Instance
     *
     * @link https://github.com/MyIntervals/emogrifier
     * @var \Pelago\Emogrifier
     */
    protected $_emogriefer;

    /**
     * @inheritDoc
     */
    public function initialize()
    {
        parent::initialize();

        $this->_emogriefer = new Emogrifier();
    }

    /**
     * @inheritDoc
     */
    public function render($view = null, $layout = null)
    {
        $output = parent::render($view, $layout);
        $output = Pinky\transformString($output)->saveHTML();

        if (!empty($this->_css)) {
            $this->getEmogriefer()->setCss($this->_css);
            $this->getEmogriefer()->setHtml($output);

            return $this->getEmogriefer()->emogrify();
        }

        return $output;
    }

    /**
     * Gets the Emogriefer instance
     *
     * @return \Pelago\Emogrifier
     */
    public function getEmogriefer()
    {
        return $this->_emogriefer;
    }

    /**
     * Sets multiple CSS files
     *
     * @param array $cssFiles A list of CSS files to read
     * @return $this
     */
    public function setCssFiles(array $cssFiles)
    {
        $css = '';
        foreach ($cssFiles as $file) {
            $css .= $this->_getCssFromFile($file);
        }

        $this->setCss($css);

        return $this;
    }

    /**
     * Sets the CSS
     *
     * @param string $css CSS File
     * @return $this
     */
    public function setCss(string $css)
    {
        $this->_css .= $css;

        return $this;
    }

    /**
     * Gets the CSS from a file
     *
     * @param string $css CSS File
     * @return string
     */
    protected function _getCssFromFile(string $file) : string
    {
        $file = WWW_ROOT . $this->Url->css($file);

        if (!file_exists($file)) {
            throw new RuntimeException(sprintf('The CSS file `%s` does not exist.', $file));
        }

        $css = file_get_contents($file);

        // Emogriefer works only with UTF-8!
        if (!mb_check_encoding($css, 'UTF-8')) {
            throw new RuntimeException(sprintf('The CSS file `$css` must be UTF-8 encoded!', $file));
        }

        return $css;
    }
}
