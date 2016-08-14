<?php 

class HeightDropdownField extends DropdownField {
	public function __construct($name, $title) {
		parent::__construct($name, $title, [
			'height: 200px;' => '200px',
			'height: 300px;' => '300px',
			'height: 400px;' => '400px',
			'height: 500px;' => '500px',
			'height: 600px;' => '600px',
			'min-height: 400px; height: 400px; height: 50vh;' => '50%',
			'min-height: 400px; height: 400px; height: 60vh;' => '60%',
			'min-height: 400px; height: 500px; height: 70vh;' => '70%',
			'min-height: 400px; height: 500px; height: 80vh;' => '80%',
			'min-height: 400px; height: 600px; height: 90vh;' => '90%',
			'min-height: 400px; height: 600px; height: 95vh;' => '95%',
			'min-height: 400px; height: 600px; height: 100vh;' => '100%',
		]);
		$this->addExtraClass('dropdown');
		$this->setEmptyString('auto');
	}
}
