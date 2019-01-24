<?php
	class UnholyFactory {
		private $undead_army = array();

		public function absorb($dead_body) {
			if (get_parent_class($dead_body) == "Fighter") {
				$new_undead = $dead_body->getType();

				if (!isset($this->undead_army[$new_undead])) {
					print("(Factory absorbed a fighter of type ".$new_undead.")\n");
					$this->undead_army[$new_undead] = $dead_body;
				} else {
					print("(Factory already absorbed a fighter of type ".$new_undead .")\n");
				}
			} else {
				print("(Factory can't absorb this, it's not a fighter)\n");
			}
		}
		public function fabricate($material) {
			if (array_key_exists($material, $this->undead_army)) {
                print("(Factory fabricates a fighter of type ".$material.")\n");
                return (clone $this->undead_army[$material]);
            }	
            print("(Factory hasn't absorbed any fighter of type ".$material.")\n");
            return (null);
		}
	}
?>