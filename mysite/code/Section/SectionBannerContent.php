<?php
//
///**
// * Class SectionContent
// *
// * @author Zauberfisch
// * @property int $ContentImageID
// * @method Image ContentImage()
// */
//class SectionBannerContent extends SectionBase {
//	private static $has_one = [
//		'ContentImage' => 'Image',
//	];
//
//	public function getCMSFields() {
//		$return = parent::getCMSFields();
//		$return->removeByName('Content');
//		$return->addFieldsToTab('Root.Main', [
//			new TextareaField('Content', $this->fieldLabel('Content')),
//			new UploadField('ContentImage', $this->fieldLabel('ContentImage')),
//		]);
//		return $return;
//	}
//
//	public function SectionGutter() {
//		return false;
//	}
//}
