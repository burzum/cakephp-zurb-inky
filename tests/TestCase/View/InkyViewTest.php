<?php
declare(strict_types = 1);

namespace Burzum\ZurbInky\Test\TestCase\View;

use Burzum\ZurbInky\View\InkyView;
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;

/**
 * InkyViewTest
 */
class InkyViewTest extends TestCase
{
    /**
     * testLayout
     */
    public function testRender()
    {
        $view = new InkyView();
        $result = $view->render('Email/test', 'Email/default');
        // The container should be a table
        $this->assertContains('<table align="center" class="container">', $result);
        // The div should have been turned into a th
        $this->assertContains('<th class="small-12 large-12 first last columns"><table><tr><th>', $result);
        // Is our content there?
        $this->assertContains('<h1>Test</h1>', $result);
    }

    /**
     * testRenderWithExternalCssFile
     */
    public function testRenderWithExternalCssFile()
    {
        $view = new InkyView();
        $view->setCssFiles([
            'one',
            'two'
        ]);

        $result = $view->render('Email/test2', 'Email/default');
        $this->assertContains('<h1 style="font-size: 30px;">', $result);
        $this->assertContains('<h2 style="font-size: 20px;">', $result);
    }

}
