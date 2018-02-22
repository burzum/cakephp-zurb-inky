<?php
namespace Burzum\ZurbInky\Test\TestCase\View;

use Burzum\ZurbInky\View\InkyView;
use Cake\TestSuite\TestCase;

/**
 * InkyViewTest
 */
class InkyViewTest extends TestCase
{

    /**
     * testLayout
     */
    public function testLayout()
    {
        $view = new InkyView();
        $result = $view->renderLayout('test', 'Email/default');

$expected = <<<'EOD'
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body><table align="center" class="container"><tbody><tr><td><table class="row"><tbody><tr><th class="small-12 large-12 first last columns"><table><tr>
<th>
        test    </th>
<th class="expander"></th>
</tr></table></th></tr></tbody></table></td></tr></tbody></table></body>
</html>
EOD;

        $this->assertEquals(trim($result), $expected);
    }
}
