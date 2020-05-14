# CakePHP plugin for Zurb Inky

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/burzum/cakephp-zurb-inky/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/burzum/cakephp-zurb-inky/)
[![Code Quality](https://img.shields.io/scrutinizer/g/burzum/cakephp-zurb-inky/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/burzum/cakephp-zurb-inky/)

A plugin to render Inky views. This will render HTML and CSS in a way it should work with most of the mail clients. It basically turns divs and
external CSS files into very old fashioned tables and inline CSS so that the retarded mail implementations will hopefully display it correctly.

 * https://foundation.zurb.com/emails/docs/inky.html

Libraries used by this plugin

 * https://github.com/lorenzo/pinky
 * https://github.com/MyIntervals/emogrifier

Requires php 7.1

## How to use it

Assuming you are using a custom mailer [as explained here](https://book.cakephp.org/3.0/en/core-libraries/email.html#creating-reusable-emails) just set the view renderer for all mails of this mailer:

```php
class MyExampleMailer extends Mailer
{
	public function __construct(Email $email = null)
	{
		parent::__construct($email);

		$this->setViewRenderer('Burzum/ZurbInky.Inky');
	}
}
```

If you want to parse the CSS as inline CSS call `setCssFiles()` in your views.

In your layout or action set the CSS files you want to use with Inky.

```php
$this->setCssFiles([
	'one',
	'two'
]);
```

The files are set using the same notation as `UrlHelper::css()` and are looked up in the apps `webroot/css` folder by default.

## License

Copyright Florian Krämer

Licensed under The MIT License
Redistributions of files must retain the above copyright notice.
