<?php

/**
 * Class SectionHolderPage
 *
 * @author zauberfisch
 */
class SectionHolderPage extends Page {
	private static $allowed_children = [
		'SectionBase',
	];

	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->removeByName('Content');
		return $return;
	}

	protected $_cachedLayoutSections;

	/**
	 * Get list of all Pages to be displayed as LayoutSection
	 * @return ArrayList|SiteTree[]|SectionBase[]
	 */
	public function LayoutSections() {
		if (!$this->_cachedLayoutSections) {
			$r = [];
			foreach ($this->AllChildren() as $child) {
				if ($child->canView()) { // && $child->is_a('SectionBase')
					if ($child->hasMethod('SectionHolderControllerInit')) {
						$child->SectionHolderControllerInit();
					}
					$r[] = $child;
				}
			}
			$this->_cachedLayoutSections = new ArrayList();
			$c = count($r);
			for ($i = 0; $i < $c; $i++) {
				$this->_cachedLayoutSections->push($r[$i]->customise([
					'PrevSection' => $i ? $r[$i - 1] : null,
					'NextSection' => $i + 1 < $c ? $r[$i + 1] : null,
				]));
			}
		}
		return $this->_cachedLayoutSections;
	}

	public function LayoutSectionsMenu() {
		return $this->LayoutSections()->filterByCallback(function ($child) {
			return !!$child->ShowInMenus;
		});
	}
}

/**
 * Class SectionHolderPage_Controller
 *
 * @author zauberfisch
 * @property SectionHolderPage dataRecord
 * @method SectionHolderPage data()
 * @mixin SectionHolderPage dataRecord
 */
class SectionHolderPage_Controller extends Page_Controller {
	private static $allowed_actions = [
		'LayoutSectionForm',
	];

	/**
	 * Form proxy for LayoutSections with forms
	 *
	 * @param null|\SS_HTTPRequest $request
	 * @return mixed|\SS_HTTPResponse
	 */
	public function LayoutSectionForm($request = null) {
		$data = $_REQUEST;
		if (isset($data['LayoutSectionID']) && $data['LayoutSectionID']
			&& isset($data['LayoutSectionFormName']) && $data['LayoutSectionFormName']
		) {
			$section = $this->data()->LayoutSections()->byID((int)$data['LayoutSectionID']);
			$method = $data['LayoutSectionFormName'];
			// make sure that the method exists on the section and is not from DataObject
			if ($section && $section->exists() && $section->hasMethod($method) && !singleton('DataObject')->hasMethod($method)) {
				return call_user_func([$section, $method], $request);
			}
		}
		return \ErrorPage::response_for(404);
	}
}
