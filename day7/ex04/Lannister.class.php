<?php
	 class Lannister {
		public function sleepWith($person) {
			if (get_parent_class($person) === "Lannister") {

				print("Not even if I'm drunk !\n");
			} else {
				print("Let's do this.\n");
			}

		}
	}
?>