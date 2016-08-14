<?php

/**
 * Class SectionMap
 *
 * @author zauberfisch
 * @property string $MapHeight
 * @method DataList|SectionMap_Marker[] MapMarkers()
 */
class SectionMap extends SectionBase {
	private static $db = [
		'MapHeight' => 'Varchar',
	];
	private static $has_many = [
		'MapMarkers' => 'SectionMap_Marker',
	];

	public function SectionGutter() {
		return false;
	}

	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->removeByName('ShowTitle');
		$return->removeByName('PreTitle');
		$return->removeByName('BackgroundColor');
		$return->removeByName('Content');
		$return->addFieldsToTab('Root.Main', [
			new HeightDropdownField('MapHeight', $this->fieldLabel('MapHeight')),
			new GridField(
				'MapMarkers',
				$this->fieldLabel('MapMarkers'),
				$this->MapMarkers(),
				new GridFieldConfig_RecordEditor()
			),
		]);
		return $return;
	}
}

/**
 * Class SectionMap_Marker
 *
 * @property string $Title
 * @property string $Type
 * @property string $Latitude
 * @property string $Longitude
 * @property string $Content
 * @property int $SectionMapID
 * @method SectionMap SectionMap()
 */
class SectionMap_Marker extends DataObject {
	private static $db = [
		'Title' => 'Varchar(255)',
		'Type' => 'Varchar(255)',
		'Latitude' => 'Varchar',
		'Longitude' => 'Varchar',
		'Content' => 'HTMLText',
	];
	private static $has_one = [
		'SectionMap' => 'SectionMap',
	];

	public function getCMSFields() {
		$s = new FormScaffolder($this);
		$s->restrictFields = ['Title', 'Latitude', 'Longitude', 'Content'];
		$f= $s->getFieldList();
		$f->insertBefore('Latitude', new DropdownField(
			'Type',
			$this->fieldLabel('Type'),
			[
				'Hotel' => _t('SectionMap_Marker.TypeValueHotel', 'Hotel'),
				'PointOfInterest' => _t('SectionMap_Marker.TypeValuePointOfInterest', 'Point of interest'),
				'Party' => _t('SectionMap_Marker.TypeValueParty', 'Party'),
				'Conference' => _t('SectionMap_Marker.TypeValueConference', 'Conference'),
			]
		));
		return $f;
	}
}
