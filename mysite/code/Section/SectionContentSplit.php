<?php

/**
 * Class SectionContent
 *
 * @author Zauberfisch
 * @property string $Content2
 * @property boolean $ShowSeparator
 * @property string $VerticalAlign
 */
class SectionContentSplit extends SectionBase {
	private static $db = [
		//'ShowContent2' => 'Boolean',
		//'Title2' => 'Varchar(255)',
		'Content2' => 'HTMLText',
		'ShowSeparator' => 'Boolean',
		'VerticalAlign' => 'Varchar',
	];
	private static $defaults = [
		'VerticalAlign' => 'middle',
	];

	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->addFieldsToTab('Root.Main', [
			new DropdownField('VerticalAlign', $this->fieldLabel('VerticalAlign'), [
				'top' => 'top',
				'middle' => 'middle',
				'bottom' => 'bottom',
			]),
		], 'Content');
		$return->addFieldsToTab('Root.Main', [
			new FieldGroup([
				new CheckboxField('ShowSeparator', $this->fieldLabel('ShowSeparator')),
			]),
			//(new CheckboxField('ShowContent2', $this->fieldLabel('ShowContent2')))
			//	->setAttribute('style', 'margin-left: -184px;'),
			//(new DisplayLogicWrapper([
			//new TextField('Title2', $this->fieldLabel('Title2')),
			new HtmlEditorField('Content2', $this->fieldLabel('Content2')),
			//]))->hideUnless('ShowContent2')->isChecked()->end(),
		]);
		return $return;
	}
}
