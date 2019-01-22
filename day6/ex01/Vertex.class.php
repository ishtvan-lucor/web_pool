<?php

require_once 'Color.class.php';

class Vertex
{
	public static $verbose;
	private $_x, $_y, $_z;
	private $_w = 0.1;
	private $_color = 0xffffff;

	public function __construct(array $kwarg)
	{
		$this->_x = $kwarg['x'];
		$this->_y = $kwarg['y'];
		$this->_z = $kwarg['z'];
		if (array_key_exists('w', $kwarg)) {
			$this->_w = $kwarg['w'];
		}
		if (array_key_exists('color', $kwarg)) {
			$this->_color = $kwarg['color'];
		}
		if (self::$verbose) {
			printf("Vertex ( x: %2.f, y: %.2f, z:%.2f, w:%.2f, ".$this->_color." ) constructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
		}
	}
	public function __destruct()
	{
		if (self::$verbose) {
			printf("Vertex ( x: %2.f, y: %.2f, z:%.2f, w:%.2f, ".$this->_color." ) destructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
		}
	}
	public function __toString()
	{
		if (self::$verbose) {
			return (sprintf("Vertex ( x: %2.f, y: %.2f, z:%.2f, w:%.2f, ".$this->_color." ) ",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color));
		}
	}
}