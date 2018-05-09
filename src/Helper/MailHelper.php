<?php
declare(strict_types = 1);

namespace Burzum\ZurbInky\View\Helper;

use Cake\View\Helper\HtmlHelper;

/**
 * Mail Helper
 */
class MailHelper extends HtmlHelper {

	public function initialize(array $config) {
		parent::initialize($config);
	}

	public function setDefaultUrlParams($params, $merge = true) {
		$this->setConfig('urlParams', $params, $merge);
	}

	public function link($title, $url = null, array $options = []) {
		if (is_array($url)) {
			if (!isset($url['?'])) {
				$url['?'] = [];
			}
			if (isset($options['urlParams'])) {
				if (is_array($options['urlParams'])) {
					$url['?'] = array_merge($url['?'], $options['urlParams']);
				}
			} else {
				$url['?'] = array_merge($url['?'], (array)$this->getConfig('urlParams'));
			}
		}

		return parent::link($title, $url, $options);
	}

}
