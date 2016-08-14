<?php

/**
 * Class SectionSliderContent
 *
 * @property string $BannerHeight
 * @property int $BannerImageID
 * @property int $BannerContentImageID
 * @method Image BannerImage()
 * @method Image BannerContentImage()
 */
class SectionBannerImage extends SectionBase {
	private static $db = [
		'BannerHeight' => 'Varchar',
	];
	private static $has_one = [
		'BannerImage' => 'Image',
		'BannerContentImage' => 'Image',
	];

	public function SectionGutter() {
		return false;
	}

	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->removeByName('Content');
		$return->removeByName('BackgroundColor');
		$return->addFieldsToTab('Root.Main', [
			new HeightDropdownField('BannerHeight', $this->fieldLabel('BannerHeight')),
			(new UploadField('BannerImage', $this->fieldLabel('BannerImage')))
				->setAllowedFileCategories('image')
				->setFolderName('banner'),
			(new UploadField('BannerContentImage', $this->fieldLabel('BannerContentImage')))
				->setAllowedFileCategories('image')
				->setFolderName('banner'),
		]);
		return $return;
	}

	protected function onBeforeWrite() {
		$this->Content = '';
		parent::onBeforeWrite();
	}
}
