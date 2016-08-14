<?php

/**
 * Class SectionContact
 *
 * @property string $FormEmail
 * @property string $FormThanksContent
 */
class SectionContact extends SectionBase {
	private static $db = [
		'FormEmail' => 'Varchar(255)',
		'FormThanksContent' => 'HTMLText',
	];
	
	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->addFieldsToTab('Root', [
			new Tab('Form', _t('SectionContact.FormTab', 'Form')),
		]);
		$return->addFieldsToTab('Root.Form', [
			new EmailField('FormEmail', $this->fieldLabel('FormEmail')),
			(new HtmlEditorField('FormThanksContent', $this->fieldLabel('FormThanksContent')))
				->setDescription(_t('SectionContact.FormThanksContentHint', 'Message to show after form')),
		]);
		return $return;
	}
	
	public function fieldLabels($includerelations = true) {
		return array_merge(
			parent::fieldLabels($includerelations),
			[
				'FormFirstName' => _t('SectionContact.FormFirstName', 'FirstName'),
				'FormLastName' => _t('SectionContact.FormLastName', 'LastName'),
				'FormEmail' => _t('SectionContact.FormEmail', 'Email'),
				'FormPhone' => _t('SectionContact.FormPhone', 'Phone'),
				'FormMessage' => _t('SectionContact.FormMessage', 'Message'),
				'FormSubmit' => _t('SectionContact.FormSubmit', 'Submit'),
			]
		);
	}
	
	public function Form() {
		return (new SectionForm(
			$this,
			__FUNCTION__,
			new FieldList([
				(new TextField('FirstName', $this->fieldLabel('FormFirstName')))
					->setAttribute('placeholder', $this->fieldLabel('FormFirstName')),
				(new TextField('LastName', $this->fieldLabel('FormLastName')))
					->setAttribute('placeholder', $this->fieldLabel('FormLastName')),
				(new EmailField('Email', $this->fieldLabel('FormEmail')))
					->setAttribute('placeholder', $this->fieldLabel('FormEmail')),
				(new TextField('Phone', $this->fieldLabel('FormPhone')))
					->setAttribute('placeholder', $this->fieldLabel('FormPhone')),
				(new TextareaField('Message', $this->fieldLabel('FormMessage')))
					->setRows(6)
					->setAttribute('placeholder', $this->fieldLabel('FormMessage')),
			]),
			new FieldList([
				new FormAction('FormSubmit', $this->fieldLabel('FormSubmit')),
			]),
			new BetterValidator(true, [
				'FirstName',
				'LastName',
				'Email',
				'Message',
			])
		));
	}
	
	public function FormSubmit($d, Form $f, SS_HTTPRequest $r) {
		Debug::log(json_encode($d));
		$text = [];
		foreach (['FirstName', 'LastName', 'Email', 'Phone', 'Message'] as $key) {
			$text[] = sprintf(
				'<b>%s:</b> %s',
				$this->data()->fieldLabel("Form$key"),
				isset($d[$key]) ? nl2br(Convert::raw2xml($d[$key])) : ''
			);
		}
		$to = 'paul.grubauer@jungbrunnen.me';
		if ($this->data()->FormEmail) {
			$to = $this->data()->FormEmail;
		}
		(new Email($to, $to, sprintf(
			'[%s] %s %s',
			SiteConfig::current_site_config()->Title,
			$d['FirstName'],
			$d['LastName']
		), implode("\r\n<br>", $text)))
			->replyTo($d['Email'])
			->send();
		return (string)$this->obj('FormThanksContent')->forTemplate();
	}
	
	public function CollapsePadding() {
		return false;
	}
}
