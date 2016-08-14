<?php

/**
 * Class SectionBase
 *
 * @author zauberfisch
 * @property boolean $ShowTitle
 * @property string $PreTitle
 * @property string $BackgroundColor
 */
class SectionBase extends Page {
	private static $db = [
		'ShowTitle' => 'Boolean',
		'PreTitle' => 'Varchar(255)',
		'BackgroundColor' => 'Varchar',
	];
	private static $defaults = [
		'ShowTitle' => '1',
		'BackgroundColor' => 'grey',
	];
	private static $allowed_children = 'none';
	private static $can_be_root = false;
	public $SectionHTMLTag = 'section';

	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->removeByName('Metadata');
		$return->removeByName('GoogleSitemap');
		$return->addFieldsToTab('Root.Main', [
			(new CheckboxField('ShowTitle', $this->fieldLabel('ShowTitle')))
				->setAttribute('style', 'margin-left: -184px;'),
			new TextField('PreTitle', $this->fieldLabel('PreTitle')),
		], 'Title');
		$return->addFieldsToTab('Root.Main', [
			(new CheckboxField('ShowInMenus', $this->fieldLabel('ShowInMenus')))
				->setAttribute('style', 'margin-left: -184px;'),
		], 'URLSegment');
		$return->addFieldsToTab('Root.Main', [
			(new ColorPaletteField('BackgroundColor', $this->fieldLabel('BackgroundColor'), [
				'white' => '#fff',
				'black' => '#231f20',
				'pink' => '#da144f',
				'yellow' => '#fff200',
				'blue-light' => '#26B7E6',
				'blue' => '#015790',
				'blue-dark' => '#142136',
				'grey' => '#F0F0F0',
			])),
		], 'Content');
		return $return;
	}

	public function canCreate($member = null) {
		if ($this->class == __CLASS__) {
			return false;
		}
		return parent::canCreate($member);
	}

	protected function onBeforeWrite() {
		parent::onBeforeWrite();
		$this->Priority = -1;
	}

	public function SectionHolderControllerInit() {
	}

	/**
	 * Render this Page for $LayoutSection
	 * @return \HTMLText
	 */
	public function LayoutSection() {
		$templates = SSViewer::get_templates_by_class(
			get_class($this),
			'',
			'SiteTree'
		);
		foreach ($templates as &$template) {
			$template = "Section/$template";
		}
		return $this->renderWith(new SSViewer($templates));
	}

	/**
	 * @param null $action
	 * @return string
	 */
	public function Link($action = null) {
		if ((is_null($action) || is_bool($action)) && $this->getParent()) {
			return $this->getParent()->Link() . '#section-' . $this->URLSegment;
		}
		return parent::Link($action);
	}

	/**
	 * @param string $action
	 * @return string
	 */
	public function PreviewLink($action = null) {
		if ($this->getParent() && ($this->getParent()->is_a('SectionHolderPage'))) {
			return $this->Link("sectionframe?action=$action");
		}
		return parent::PreviewLink($action);
	}

	public function SectionClasses() {
		$classes = [];
		foreach (array_reverse(ClassInfo::ancestry($this->class)) as $class) {
			if ($class == __CLASS__) {
				break;
			}
			$classes[] = "section-type-$class";
		}
		return implode(' ', $classes);
	}

	public function SectionGutter() {
		return true;
	}
}

/**
 * Class SectionBase_Controller
 *
 * @author zauberfisch
 * @property SectionBase dataRecord
 * @method SectionBase data()
 * @mixin SectionBase dataRecord
 */
class SectionBase_Controller extends \Page_Controller {
	private static $allowed_actions = [
		'sectionframe',
	];

	public function sectionframe(\SS_HTTPRequest $r) {
		return sprintf(
			'<iframe frameborder="0" src="%s"></iframe><style>%s</style>',
			\Controller::join_links(
				$this->data()->getParent()->Link($r->getVar('action'))
			//, "#section-{$this->data()->URLSegment}"
			),
			'* { margin: 0; padding: 0; width: 100%; height: 100%; }'
		);
	}
}
