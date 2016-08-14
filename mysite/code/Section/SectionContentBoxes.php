<?php

/**
 * Class SectionTeasers
 *
 * @property int $ItemsColumns
 * @property boolean $ItemsSeparator
 * @method DataList|SectionContentBoxes_Box[] Items()
 */
class SectionContentBoxes extends SectionBase {
	private static $db = [
		'ItemsColumns' => 'Int',
		'ItemsSeparator' => 'Boolean',
	];
	private static $has_many = [
		'Items' => 'SectionContentBoxes_Box',
	];
	private static $defaults = [
		'ItemsColumns' => '2',
	];

	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->removeByName('Content');
		$return->addFieldsToTab('Root.Main', [
			new FieldGroup([
				(new TextField('ItemsColumns', $this->fieldLabel('ItemsColumns')))
					->setAttribute('min', '2')
					->setAttribute('max', '4')
					->setAttribute('type', 'number'),
				//new CheckboxField('ItemsSeparator', $this->fieldLabel('ItemsSeparator')),
			]),
			new GridField(
				'Items',
				$this->fieldLabel('Items'),
				$this->Items(),
				(new GridFieldConfig_RecordEditor())
					->removeComponentsByType('GridFieldSortableHeader')
					->addComponent(new GridFieldTitleHeader())
					->addComponent(new GridFieldOrderableRows())
			),
		]);
		return $return;
	}

	protected function onBeforeWrite() {
		parent::onBeforeWrite();
		if ($this->ItemsColumns > 4) {
			$this->ItemsColumns = 4;
		} elseif ($this->ItemsColumns < 1) {
			$this->ItemsColumns = 1;
		}
	}
}
