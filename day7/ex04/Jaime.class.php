<?php
	include_once('Lannister.class.php');

	class Jaime extends Lannister {
		public function sleepWith($person) {
			if (get_class($person) == "Cersei") {
				print("With pleasure, but only in a tower in Winterfell, then.\n");
			} else {
				parent::sleepWith($person);
			}
	}
	}
?>