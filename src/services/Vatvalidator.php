<?php

/**
 * VAT Checker plugin for Craft CMS 3.x
 *
 * Validates and returns company info of VAT Number in Europe
 *
 * @link      https://koeketienedesign.be/
 * @copyright Copyright (c) 2020 Stefanie Gevaert
 */

namespace koeketienedesign\vatchecker\services;

use koeketienedesign\vatchecker\VatChecker;

use Craft;
use craft\base\Component;

/**
 * Vatvalidator Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Stefanie Gevaert
 * @package   VatChecker
 * @since     1.0.0
 */
class Vatvalidator extends Component
{
  // Public Methods
  // =========================================================================

  /**
   * This function can literally be anything you want, and you can have as many service
   * functions as you want
   *
   * From any other plugin file, call it like this:
   *
   *     VatChecker::$plugin->vatvalidator->exampleService()
   *
   * @return mixed
   */
  public function validateVat($value)
  {
    $vat_number = str_replace(array(' ', '.', '-', ',', ', '), '', trim($value));

    $contents = @file_get_contents('https://controleerbtwnummer.eu/api/validate/' . $vat_number . '.json');
    if ($contents === false) {
      echo "service unavailable";
    } else {
      $result = json_decode($contents);
    }

    return $result;
  }
}
