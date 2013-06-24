<?php

if (in_array($argv[1], array('--help', '-help', '-h', '-?'))) {
?>

Vector Sunburst Generator - Digital Phantom

  Usage:
  <?php echo $argv[0]; ?> [file] [sides] [radius]

  [file] - file name where SVG file will be saved
  [sides] - the number of rays the sunburst will have
  [radius] - radius of the sunburst

(c) 2013 Digital Phantom - http://www.digitalphantom.net/
authored by: Yoel Nunez http://www.yoelnunez.com/
<?php
	exit;
}
else if($argc < 4) {
	exit("\nERROR: Pleasy type {$argv[0]} -h for help.\n\n");
}

$filename = $argv[1];
$sides = $argv[2];
$radius = $argv[3];

if(trim($filename) == "") {
	exit("\nERROR: filename cannot be please refer to the usage details for instructions.\n\n");
} else if(!is_numeric($sides)) {
	exit("\nERROR: The number of sides \"{$sides}\" has to be an integer value.\n\n");
}
else if(!is_numeric($radius)) {
	$radius = 50;
}

$points = 5 * $sides;

$angle = 360 / $points;

$coordinates = "";

for($i = 0; $i < $points; $i++) {
	$ix = sin(deg2rad($i * $angle)) * $radius;
	$iy = cos(deg2rad($i * $angle)) * - 1 * $radius;

	$x = $radius + $ix;
	$y = $radius + $iy;

	if($i % 5 == 0)	{
		$x = $y = $radius;
	}

	$coordinates .= "{$x},{$y} ";
}

$handle = fopen($filename, "w+");

if($handle) {
	fwrite($handle, '<svg xmlns="http://www.w3.org/2000/svg" version="1.1">');
	fwrite($handle, '<polygon points="'.trim($coordinates).'" style="fill:#000;"/>');
	fwrite($handle, '</svg>');
	fclose($handle);

	echo "\nYour vector file \"{$filename}\" was succesfully generated.\n\n";
}
else {
	echo "\nERROR: The file \"{$filename}\" could not be opened.\n\n";
}
