<?php
namespace Views;

class FormularioParticipa
{
	
	public function __construct()
	{
		$this->printTemplate();
	}

	public function printTemplate() {
		include APP_PATH."\Templates\participa.html";
	}
}
