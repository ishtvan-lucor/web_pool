<?php

class Matrix
{
	public static $verbose = FALSE;
	private $_m;
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "Ox ROTATION";
	const RY = "Oy ROTATION";
	const RZ = "Oz ROTATION";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";

	public function __construct(array $kwarg)
	{
		if (isset($kwarg)) {
			$this->_setZeroMatrix();
		}
		if (array_key_exists('preset', $kwarg)) {
			$this->_setTypeMatrix($kwarg);
		}
		if (self::$verbose) {
			if ($kwarg['preset'] == self::IDENTITY) {
				print("Matrix IDENTITY instance constructed\n");
			}
			else {
				print("Matrix " . $kwarg['preset'] . " preset instance constructed");
			}
		}
	}
	public function __destruct()
	{
		if (self::$verbose) {
			print("Matrix instance destructed\n");
		}
	}
	public function __toString()
	{
		$str = sprintf("M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\nx | %0.2f | %0.2f | %0.2f | %0.2f\ny | %0.2f | %0.2f | %0.2f | %0.2f\nz | %0.2f | %0.2f | %0.2f | %0.2f\nw | %0.2f | %0.2f | %0.2f | %0.2f", $this->_m["x"]["vtcX"], $this->_m["x"]["vtcY"], $this->_m["x"]["vtcZ"], $this->_m["x"]["vtxO"], $this->_m["y"]["vtcX"], $this->_m["y"]["vtcY"], $this->_m["y"]["vtcZ"], $this->_m["y"]["vtxO"], $this->_m["z"]["vtcX"], $this->_m["z"]["vtcY"], $this->_m["z"]["vtcZ"], $this->_m["z"]["vtxO"], $this->_m["w"]["vtcX"], $this->_m["w"]["vtcY"], $this->_m["w"]["vtcZ"], $this->_m["w"]["vtxO"]);
		return $str;
	}
	public function doc() {
		return file_get_contents("Matrix.doc.txt");
	}
	public function mult(Matrix $matrix)
	{
		$x = array("vtcX" => $this->_multHelper("x", "vtcX", $matrix),
			"vtcY" => $this->_multHelper("x", "vtcY", $matrix),
			"vtcZ" => $this->_multHelper("x", "vtcZ", $matrix),
			"vtxO" => $this->_multHelper("x", "vtxO", $matrix));
		$y = array("vtcX" => $this->_multHelper("y", "vtcX", $matrix),
			"vtcY" => $this->_multHelper("y", "vtcY", $matrix),
			"vtcZ" => $this->_multHelper("y", "vtcZ", $matrix),
			"vtxO" => $this->_multHelper("y", "vtxO", $matrix));
		$z = array("vtcX" => $this->_multHelper("z", "vtcX", $matrix),
			"vtcY" => $this->_multHelper("z", "vtcY", $matrix),
			"vtcZ" => $this->_multHelper("z", "vtcZ", $matrix),
			"vtxO" => $this->_multHelper("z", "vtxO", $matrix));
		$w = array("vtcX" => $this->_multHelper("w", "vtcX", $matrix),
			"vtcY" => $this->_multHelper("w", "vtcY", $matrix),
			"vtcZ" => $this->_multHelper("w", "vtcZ", $matrix),
			"vtxO" => $this->_multHelper("w", "vtxO", $matrix));
		$resMatrix = array("x" => $x, "y" => $y, "z" => $z, "w" => $w);
		$res = new Matrix(array( 'preset' => Matrix::IDENTITY ));
		$res->_m = $resMatrix;
		return $res;
	}
	public function transformVertex(Vertex $vtx)
	{
		$x = ($vtx->getX() * $this->_m["x"]["vtcX"]) +
			($vtx->getY() * $this->_m["x"]["vtcY"]) +
			($vtx->getZ() * $this->_m["x"]["vtcZ"]) +
			($vtx->getW() * $this->_m["x"]["vtxO"]);
		$y = ($vtx->getX() * $this->_m["y"]["vtcX"]) +
			($vtx->getY() * $this->_m["y"]["vtcY"]) +
			($vtx->getZ() * $this->_m["y"]["vtcZ"]) +
			($vtx->getW() * $this->_m["y"]["vtxO"]);
		$z = ($vtx->getX() * $this->_m["z"]["vtcX"]) +
			($vtx->getY() * $this->_m["z"]["vtcY"]) +
			($vtx->getZ() * $this->_m["z"]["vtcZ"]) +
			($vtx->getW() * $this->_m["z"]["vtxO"]);
		$w = ($vtx->getX() * $this->_m["w"]["vtcX"]) +
			($vtx->getY() * $this->_m["w"]["vtcY"]) +
			($vtx->getZ() * $this->_m["w"]["vtcZ"]) +
			($vtx->getW() * $this->_m["w"]["vtxO"]);
		$clr = $vtx->getColor();
		$vertex = new Vertex(array("x" => $x, "y" => $y, "z" => $z, "w" => $w, "color" => $clr));
		return $vertex;
	}
	private function _setTypeMatrix(array $kwarg) {
		if ($kwarg['preset'] == self::IDENTITY) {
			$this->_identityMatrix();
		}
		else if ($kwarg['preset'] == self::SCALE) {
			$this->_scaleMatrix($kwarg['scale']);
		}
		else if ($kwarg['preset'] == self::RX && array_key_exists('angle', $kwarg)) {
			$this->_rotationX($kwarg['angle']);
		}
		else if ($kwarg['preset'] == self::RY && array_key_exists('angle', $kwarg)) {
			$this->_rotationY($kwarg['angle']);
		}
		else if ($kwarg['preset'] == self::RZ && array_key_exists('angle', $kwarg)) {
			$this->_rotationZ($kwarg['angle']);
		}
		else if ($kwarg['preset'] == self::TRANSLATION &&
			array_key_exists('vtc', $kwarg) && $kwarg['vtc'] instanceof Vector) {
			$this->_translationMatrix($kwarg['vtc']);
		}
		else if ($kwarg['preset'] == self::PROJECTION &&
			array_key_exists('fov', $kwarg) && array_key_exists('ratio', $kwarg) &&
			array_key_exists('near', $kwarg) && array_key_exists('far', $kwarg)) {
			$this->_projectionMatrix($kwarg['fov'], $kwarg['ratio'], $kwarg['near'], $kwarg['far']);
		}
	}

	private function _setZeroMatrix() {
		$x = array('vtcX' => 0.0, 'vtcY' => 0.0, 'vtcZ' => 0.0, 'vtxO => 0.0');
		$y = array('vtcX' => 0.0, 'vtcY' => 0.0, 'vtcZ' => 0.0, 'vtxO => 0.0');
		$z = array('vtcX' => 0.0, 'vtcY' => 0.0, 'vtcZ' => 0.0, 'vtxO => 0.0');
		$w = array('vtcX' => 0.0, 'vtcY' => 0.0, 'vtcZ' => 0.0, 'vtxO => 0.0');
		$this->_m = array('x' => $x, 'y' => $y, 'z' => $z, 'w' => $w);
	}
	private function _identityMatrix() {
		$this->_m['x']["vtcX"] = 1.0;
		$this->_m['y']["vtcY"] = 1.0;
		$this->_m['z']["vtcZ"] = 1.0;
		$this->_m['w']["vtxO"] = 1.0;
	}
	private function _scaleMatrix($scale) {
		$this->_m['x']["vtcX"] = $scale;
		$this->_m['y']["vtcY"] = $scale;
		$this->_m['z']["vtcZ"] = $scale;
		$this->_m['w']["vtxO"] = 1.0;
	}
	private function _rotationX($angle) {
		$this->_identityMatrix();
		$this->_m["y"]["vtcY"] = cos($angle);
		$this->_m["y"]["vtcZ"] = -sin($angle);
		$this->_m["z"]["vtcY"] = sin($angle);
		$this->_m["z"]["vtcZ"] = cos($angle);
	}
	private function _rotationY($angle) {
		$this->_identityMatrix();
		$this->_m["x"]["vtcX"] = cos($angle);
		$this->_m["x"]["vtcZ"] = sin($angle);
		$this->_m["z"]["vtcX"] = -sin($angle);
		$this->_m["z"]["vtcZ"] = cos($angle);
	}
	private function _rotationZ($angle) {
		$this->_identityMatrix();
		$this->_m["x"]["vtcX"] = cos($angle);
		$this->_m["x"]["vtcY"] = -sin($angle);
		$this->_m["y"]["vtcY"] = -cos($angle);
		$this->_m["y"]["vtcX"] = sin($angle);
	}
	private function _translationMatrix(Vector $vtc) {
		$this->_identityMatrix();
		$this->_m["x"]["vtxO"] = $vtc->getX();
		$this->_m["y"]["vtxO"] = $vtc->getY();
		$this->_m["z"]["vtxO"] = $vtc->getZ();
	}
	private function _projectionMatrix($fov, $ratio, $near, $far) {
		$this->_identityMatrix();
		$this->_m["y"]["vtcY"] = 1 / tan(0.5 * deg2rad($fov));
		$this->_m["x"]["vtcX"] = $this->_m["y"]["vtcY"] / $ratio;
		$this->_m["z"]["vtcZ"] = ($near + $far) / ($near - $far);
		$this->_m["z"]["vtxO"] = (2 * $near * $far) / ($near - $far);
		$this->_m["w"]["vtcZ"] = -1;
		$this->_m["w"]["vtxO"] = 0;
	}
	private function _multHelper($row, $col, Matrix $matrix)
	{
		$res = $this->_m[$row]["vtcX"] * $matrix->_m["x"][$col];
		$res += $this->_m[$row]["vtcY"] * $matrix->_m["y"][$col];
		$res += $this->_m[$row]["vtcZ"] * $matrix->_m["z"][$col];
		$res += $this->_m[$row]["vtxO"] * $matrix->_m["w"][$col];
		return ($res);
	}
}