<?php
	abstract class Fighter {
		private $type;

		abstract public function fight($target);
		public function __construct($solder_type) {
			$this->type = $solder_type;
		}
		public function getType() {
			return $this->type;
		}
	}
?>