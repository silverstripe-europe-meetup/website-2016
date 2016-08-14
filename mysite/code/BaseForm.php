<?php

/**
 * Base Form that allows singleton
 */
class BaseForm extends Form {
	/**
	 * @param \Controller $controller
	 * @param String $name
	 * @param \FieldList $fields
	 * @param \FieldList $actions
	 * @param null $validator
	 */
	public function __construct($controller = null, $name = null, \FieldList $fields = null, \FieldList $actions = null, $validator = null) {
		if (!is_null($controller)) {
			parent::__construct($controller, $name, $fields, $actions, $validator);
			$this->addExtraClass('base-form');
		}
	}
}
