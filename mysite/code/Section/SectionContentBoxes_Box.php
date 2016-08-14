<?php

/**
 * Class SectionTeasers_Teaser
 *
 * @property string $Title
 * @property string $Content
 * @property int $Sort
 * @property int $SectionContentBoxesID
 * @method SectionContentBoxes SectionContentBoxes()
 */
class SectionContentBoxes_Box extends DataObject {
	private static $db = [
		'Title' => 'Varchar(255)',
		'Content' => 'HTMLText',
		'Sort' => 'Int',
	];
	private static $has_one = [
		'SectionContentBoxes' => 'SectionContentBoxes',
		//'Image' => 'Image',
	];
	private static $default_sort = 'Sort ASC';

	public function getCMSFields() {
		$s = new FormScaffolder($this);
		//$s->restrictFields = ['Title', 'Content', 'Image'];
		$s->restrictFields = ['Title', 'Content'];
		return $s->getFieldList();
	}
}
