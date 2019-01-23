<?php

class Vertex
{
	public static $verbose = FALSE;
	private $_x, $_y, $_z;
	private $_w = 1.0;
	private $_color;

	public function __construct(array $kwarg)
	{
		$this->_x = $kwarg['x'];
		$this->_y = $kwarg['y'];
		$this->_z = $kwarg['z'];
		if (array_key_exists('w', $kwarg)) {
			$this->_w = $kwarg['w'];
		}
		if (array_key_exists('color', $kwarg) && $kwarg['color'] instanceof Color) {
			$this->_color = $kwarg['color'];
		}
		else {
			$this->_color = new Color(array('rgb' => 0xffffff));
		}
		if (self::$verbose) {
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, ".$this->_color." ) constructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
		}
	}
	public function __destruct()
	{
		if (self::$verbose) {
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, ".$this->_color." ) destructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color);
		}
	}
	public function __toString() {
		$str = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f", $this->_x, $this->_y, $this->_z, $this->_w);
		if (self::$verbose) {
			$str .= ", ".$this->_color." )";
		} else {
			$str .= " )";
		}
		return $str;
	}
	public static function doc()
	{
		return file_get_contents("Vertex.doc.txt")."\n";
	}
	public function setX($val) {
		$this->_x = $val;
	}
	public function setY($val) {
		$this->_y = $val;
	}
	public function setZ($val) {
		$this->_z = $val;
	}
	public function setW($val) {
		$this->_w = $val;
	}
	public function setColor($val) {
		$this->_color = $val;
	}
	public function getX() {
		return ($this->_x);
	}
	public function getY() {
		return ($this->_y);
	}
	public function getZ() {
		return ($this->_z);
	}
	public function getW() {
		return ($this->_w);
	}
	public function getColor() {
		return ($this->_color);
	}
}