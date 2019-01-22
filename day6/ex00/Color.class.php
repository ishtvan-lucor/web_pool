<?php

define("BASE", (int)256);

class Color
{
	public $red = 0;
	public $green = 0;
	public $blue = 0;
	public static $verbose = FALSE;

	public function __construct(array $kwargs)
	{
		if (array_key_exists('rgb', $kwargs)) {
			$this->blue = intval($kwargs['rgb'] % BASE);
			$this->green = intval($kwargs['rgb'] / BASE % BASE);
			$this->red = intval($kwargs['rgb'] / BASE % BASE);
		}
		else if (array_key_exists('red', $kwargs) &&
		array_key_exists('green', $kwargs) &&
		array_key_exists('blue', $kwargs)) {
			$this->red = $kwargs['red'];
			$this->green = $kwargs['green'];
			$this->blue = $kwargs['blue'];
		}
		if (self::$verbose) {
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
		}
	}
	public function __destruct()
	{
		if (self::$verbose) {
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
		}
	}
	public function __toString()
	{
		return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue));
	}
	public static function doc()
	{
		return (file_get_contents("Color.doc.txt") . "\n");
	}
	public function add($color)
	{
		return (new Color( array( 'red' => $this->red + $color->red, 'green' => $this->green + $color->green, 'blue' => $this->blue + $color->blue)));
	}
	public function sub($color)
	{
		return (new Color( array( 'red' => $this->red - $color->red, 'green' => $this->green - $color->green, 'blue' => $this->blue - $color->blue)));
	}
	public function mult($color)
	{
		return (new Color( array( 'red' => $this->red * $color->red, 'green' => $this->green * $color->green, 'blue' => $this->blue * $color->blue)));
	}
}