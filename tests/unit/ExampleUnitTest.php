<?php
/**
 * VAT Checker plugin for Craft CMS 3.x
 *
 * Validates and returns company info of VAT Number in Europe
 *
 * @link      https://koeketienedesign.be/
 * @copyright Copyright (c) 2020 Stefanie Gevaert
 */

namespace koeketienedesign\vatcheckertests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use koeketienedesign\vatchecker\VatChecker;

/**
 * ExampleUnitTest
 *
 *
 * @author    Stefanie Gevaert
 * @package   VatChecker
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            VatChecker::class,
            VatChecker::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
