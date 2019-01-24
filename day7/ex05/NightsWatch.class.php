<?php
	include_once('IFighter.class.php');

	class NightsWatch implements IFighter {
		private $guards = array();

		public function recruit($brother) {
			$this->guards[] = $brother;
		}
		function fight() {
			foreach($this->guards as $brother) {
				if (method_exists($brother, 'fight'))
					$brother->fight();
			}
		}
	}
?>