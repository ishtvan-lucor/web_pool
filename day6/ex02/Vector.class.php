<?php

class Vector
{
	public static $verbose = FALSE;
	private $_x, $_y, $_z, $_w;

	public function __construct($kwarg)
	{
		if (array_key_exists('dest', $kwarg) && $kwarg['dest'] instanceof Vertex) {
			$dest = $kwarg['dest'];
			$this->_x = $dest->getX();
			$this->_y = $dest->getY();
			$this->_z = $dest->getZ();
			$this->_w = 0.0;
			if (array_key_exists('orig', $kwarg) && $kwarg['orig'] instanceof  Vertex) {
				$orig = $kwarg['orig'];
			}
			else {
				$orig = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0));
			}
			$this->_x -= $orig->getX();
			$this->_y -= $orig->getY();
			$this->_z -= $orig->getZ();
			$this->_w = 0.0;
		}
		if (self::$verbose == TRUE) {
			printf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f ) constructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w);
		}
	}
	public function __destruct()
	{
		if (self::$verbose == TRUE) {
			printf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f ) destructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w);
		}
	}
	public function __toString()
	{
		return sprintf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f )",
			$this->_x, $this->_y, $this->_z, $this->_w);
	}
	public static function doc() {
		return file_get_contents("Vector.doc.txt")."\n";
	}
	public function getX() {
		return $this->_x;
	}
	public function getY() {
		return $this->_y;
	}
	public function getZ() {
		return $this->_z;
	}
	public function getW() {
		return $this->_w;
	}
	public function magnitude() {
		return sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z);
	}
	public function normalize() {
		if (($length = $this->magnitude()) == 1) {
			return (clone $this);
		}
		$dest = new Vertex(array('x' => ($this->_x / $length),
			'y' => ($this->_y / $length), 'z' => ($this->_z / $length)));
		return (new Vector(array('dest' => $dest)));
	}
	public function add(Vector $rhs) {
		$x = $this->_x + $rhs->getX();
		$y = $this->_y + $rhs->getY();
		$z = $this->_z + $rhs->getZ();
		$vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
		return (new Vector(array('dest' => $vertex)));
	}
	public function sub(Vector $rhs) {
		$x = $this->_x - $rhs->getX();
		$y = $this->_y - $rhs->getY();
		$z = $this->_z - $rhs->getZ();
		$vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
		return (new Vector(array('dest' => $vertex)));
	}
	public function opposite() {
		$x = $this->_x * (-1);
		$y = $this->_y * (-1);
		$z = $this->_z * (-1);
		$vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
		return (new Vector(array('dest' => $vertex)));
	}
	public function scalarProduct($k) {
		$x = $this->_x * $k;
		$y = $this->_y * $k;
		$z = $this->_z * $k;
		$vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
		return (new Vector(array('dest' => $vertex)));
	}
	public function dotProduct(Vector $rhs) {
		return ((float)($this->_x * $rhs->getX() + $this->_y * $rhs->getY() + $this->_z * $rhs->getZ()));
	}
	public function cos(Vector $rhs) {
		return ((float)($this->dotProduct($rhs) / sqrt($this->dotProduct($this) * $rhs->dotProduct($rhs))));
	}
	public function crossProduct(Vector $rhs) {
		$x = $this->_y * $rhs->getZ() - $this->_z * $rhs->getY();
		$y = $this->_z * $rhs->getX() - $this->_x * $rhs->getZ();
		$z = $this->_x * $rhs->getY() - $this->_y * $rhs->getX();
		$vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
		return (new Vector(array('dest' => $vertex)));
	}
}