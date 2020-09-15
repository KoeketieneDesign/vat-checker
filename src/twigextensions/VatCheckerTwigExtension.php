<?php

/**
 * VAT Checker plugin for Craft CMS 3.x
 *
 * Validates and returns company info of VAT Number in Europe
 *
 * @link      https://koeketienedesign.be/
 * @copyright Copyright (c) 2020 Stefanie Gevaert
 */

namespace koeketienedesign\vatchecker\twigextensions;

use koeketienedesign\vatchecker\VatChecker;
use koeketienedesign\vatchecker\services\Vatvalidator as VatvalidatorService;

use Craft;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Stefanie Gevaert
 * @package   VatChecker
 * @since     1.0.0
 */
class VatCheckerTwigExtension extends AbstractExtension
{
  // Public Methods
  // =========================================================================
  public function getName()
  {
    return 'VAT Checker';
  }

  public function getFilters()
  {
    return [
      new TwigFilter('vat', [$this, 'vat']),
    ];
  }

  public function vat($value = null, $format = 'validate')
  {
    // validate or info
    $result = "";

    $vatValidatorHelper = new VatvalidatorService();

    $vatValidation = $vatValidatorHelper->validateVat($value);
    $result = $vatValidation->valid;

    if('validate' !== $format){
      $result = $vatValidation;
    }

    return $result;
  }
}
