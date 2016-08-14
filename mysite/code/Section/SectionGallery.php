<?php

/**
 * Class SectionTeasers
 *
 * @method ManyManyList|Image[] GalleryImages()
 */
class SectionGallery extends SectionBase {
	private static $many_many = [
		'GalleryImages' => 'Image',
	];
	private static $many_many_extraFields = [
		'GalleryImages' => [
			'SortOrder' => 'Int',
		],
	];

	public function SectionGutter() {
		//return !$this->SliderFullWidth;
		return false;
	}

	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->removeByName('Content');
		$return->addFieldsToTab('Root.Main', [
			(new SortableUploadField('GalleryImages', $this->fieldLabel('GalleryImages')))
				->setAllowedFileCategories('image')
				->setFolderName('gallery'),
		]);
		return $return;
	}
}
