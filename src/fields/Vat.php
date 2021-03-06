<?php

/**
 * VAT Checker plugin for Craft CMS 3.x
 *
 * Validates and returns company info of VAT Number in Europe
 *
 * @link      https://koeketienedesign.be/
 * @copyright Copyright (c) 2020 Stefanie Gevaert
 */

namespace koeketienedesign\vatchecker\fields;

use koeketienedesign\vatchecker\VatChecker;
use koeketienedesign\vatchecker\validators\VatValidator;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * Vat Field
 *
 * Whenever someone creates a new field in Craft, they must specify what
 * type of field it is. The system comes with a handful of field types baked in,
 * and we’ve made it extremely easy for plugins to add new ones.
 *
 * https://craftcms.com/docs/plugins/field-types
 *
 * @author    Stefanie Gevaert
 * @package   VatChecker
 * @since     1.0.0
 */
class Vat extends Field
{
  // Public Properties
  // =========================================================================

  // Static Methods
  // =========================================================================

  /**
   * Returns the display name of this class.
   *
   * @return string The display name of this class.
   */
  public static function displayName(): string
  {
    return Craft::t('vat-checker', 'VAT Field');
  }

  // Public Methods
  // =========================================================================

  /**
   * Returns the column type that this field should get within the content table.
   *
   * This method will only be called if [[hasContentColumn()]] returns true.
   *
   * @return string The column type. [[\yii\db\QueryBuilder::getColumnType()]] will be called
   * to convert the give column type to the physical one. For example, `string` will be converted
   * as `varchar(255)` and `string(100)` becomes `varchar(100)`. `not null` will automatically be
   * appended as well.
   * @see \yii\db\QueryBuilder::getColumnType()
   */
  public function getContentColumnType(): string
  {
    return Schema::TYPE_STRING;
  }

  /**
   * Normalizes the field’s value for use.
   *
   * This method is called when the field’s value is first accessed from the element. For example, the first time
   * `entry.myFieldHandle` is called from a template, or right before [[getInputHtml()]] is called. Whatever
   * this method returns is what `entry.myFieldHandle` will likewise return, and what [[getInputHtml()]]’s and
   * [[serializeValue()]]’s $value arguments will be set to.
   *
   * @param mixed                 $value   The raw field value
   * @param ElementInterface|null $element The element the field is associated with, if there is one
   *
   * @return mixed The prepared field value
   */
  public function normalizeValue($value, ElementInterface $element = null)
  {
    return $value;
  }

  /**
   * Prepares the field’s value to be stored somewhere, like the content table or JSON-encoded in an entry revision table.
   *
   * Data types that are JSON-encodable are safe (arrays, integers, strings, booleans, etc).
   * Whatever this returns should be something [[normalizeValue()]] can handle.
   *
   * @param mixed $value The raw field value
   * @param ElementInterface|null $element The element the field is associated with, if there is one
   * @return mixed The serialized field value
   */
  public function serializeValue($value, ElementInterface $element = null)
  {
    return parent::serializeValue($value, $element);
  }

  /**
   * Returns the field’s input HTML.
   *
   * @param mixed                 $value           The field’s value. This will either be the [[normalizeValue() normalized value]],
   *                                               raw POST data (i.e. if there was a validation error), or null
   * @param ElementInterface|null $element         The element the field is associated with, if there is one
   *
   * @return string The input HTML.
   */
  public function getInputHtml($value, ElementInterface $element = null): string
  {
    // Render the input template
    return Craft::$app->getView()->renderTemplate(
      '_includes/forms/text',
      [
        'name' => $this->handle,
        'value' => $value,
        'field' => $this,
      ]
    );
  }

  /**
   * @inheritdoc
   */
  public function getElementValidationRules(): array
  {
    return [VatValidator::class];
  }
}
