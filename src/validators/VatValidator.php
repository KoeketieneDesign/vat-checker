<?php

namespace koeketienedesign\vatchecker\validators;
use koeketienedesign\vatchecker\services\Vatvalidator as VatvalidatorService;

use Craft;
use yii\validators\Validator;

class VatValidator extends Validator
{
  /**
   * @inheritdoc
   */
  public function validateValue($value)
  {
    $vatValidatorHelper = new VatvalidatorService();

    $vatValidation = $vatValidatorHelper->validateVat($value);

    if(false === $vatValidation->valid){
      return [Craft::t('vat-checker', 'The VAT that you have is not valid.'), []];
    }

    return null;
  }
}
