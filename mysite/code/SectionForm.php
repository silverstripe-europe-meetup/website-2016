<?php

/**
 * @author zauberfisch
 */
class SectionForm extends BaseForm {
	protected $parent;

	/**
	 * @param \DataObject|\Page $model
	 * @param string $name
	 * @param \FieldList $fields
	 * @param \FieldList $actions
	 * @param \Validator $validator
	 */
	public function __construct(\DataObject $model = null, $name = null, \FieldList $fields = null, \FieldList $actions = null, $validator = null) {
		if (!is_null($model)) {
			$this->parent = $model;
			$this->setHTMLID("Form_{$model->class}_{$name}");
			$fields->push(\HiddenField::create('LayoutSectionID', null, $model->ID));
			$fields->push(\HiddenField::create('LayoutSectionFormName', null, $name));
			parent::__construct(\Controller::curr(), 'LayoutSectionForm', $fields, $actions, $validator);
			$this->disableSecurityToken();
			$this->setRedirectToFormOnValidationError(true);
		}
	}

	/**
	 * Include action methods that are on the Section
	 *
	 * @param string $method
	 * @return bool
	 */
	public function hasMethod($method) {
		if (!parent::hasMethod($method)) {
			// allow calling actions on the page
			return $this->hasActionOnSection($method);

		}
		return true;
	}

	/**
	 * check if a given action exists on the Section
	 *
	 * @param string $method
	 * @return bool
	 */
	public function hasActionOnSection($method) {
		// make sure that the method exists on the section and is not from DataObject
		return $this->Actions()->fieldByName("action_$method") && $this->parent->hasMethod($method) && !singleton('DataObject')->hasMethod($method);
	}

	/**
	 * pipe call to action method to the Section
	 *
	 * @param string $method
	 * @param array $arguments
	 * @return mixed
	 * @throws Exception
	 */
	public function __call($method, $arguments) {
		if ($this->hasActionOnSection($method)) {
			return call_user_func_array(array($this->parent, $method), $arguments);
		}
		return parent::__call($method, $arguments);
	}
}


