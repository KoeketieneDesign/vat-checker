# VAT Checker plugin for Craft CMS 3.x

Validates and returns company info of VAT Number in Europe

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require cookie10codes/vat-checker

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for VAT Checker.

## VAT Checker Overview

Custom field to use in craft to get a valid European VAT number. You can use this also in twig if you want to hardcode a value. You can also receive the company info from the VAT in the twig filter.

## Using VAT Checker

### Custom field

Create a new field by selecting VAT Field on the dropdown. No need to add extra info

### Twig filter

You can use the `|vat` filter to validate a VAT number. If you want company info add `info` as param to the function

```twig
{{ entry.vatField|vat }}
{# Output: 1|0 --> depending on if it's valid or not #}

{{ entry.vatField|vat('info') }}
{# Output: "
  object(stdClass)[1591]
    public 'valid' => boolean true
    public 'countryCode' => string 'BE' (length=2)
    public 'vatNumber' => string '0688696733' (length=10)
    public 'name' => string 'BVBA KOEKETIENE DESIGN' (length=22)
    public 'address' =>
      object(stdClass)[1598]
        public 'street' => string 'Kanunnikenstraat(mar)' (length=21)
        public 'number' => string '8' (length=1)
        public 'zip_code' => string '8510' (length=4)
        public 'city' => string 'Kortrijk' (length=8)
        public 'country' => string 'België' (length=7)
        public 'countryCode' => string 'BE' (length=2)
    public 'strAddress' => string 'Kanunnikenstraat(Mar) 8
  8510 Kortrijk' (length=37)
" #}
```

## VAT Checker Roadmap

None at this moment. All suggestions are welcome

Brought to you by [Stefanie Gevaert](https://koeketienedesign.be/)
