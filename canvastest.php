<?php

if (isset($_GET['3141592654'])) die(highlight_file(__FILE__, 1));
if (isset($_GET['31415926'])) define('DEVEL', true);
else define('DEVEL', false);

define('CANVAS_MAX_X', rand()%600+640);
define('CANVAS_MAX_Y', rand()%400+480);
define('CANVAS_NAME', 'herpderp');

$canvasFunctionsDefine = array(
	'things' => 'drv = drv, max = 100',
	'test' => 'drv = drv, max = 100',
	'circles' => 'drv = drv, maxradius = 50, max = 30',
	'rectangles' => 'drv = drv, max = 20, minx = 300, miny = 200'
);

$canvasFunctionsRun = array(
	'things_1' => array('things' => 'drv = drv, max = '.rand()%60),
	'circles_3' => array('circles' => 'drv = drv, maxradius = 90, max = 100'),
	'circles_1' => array('circles' => 'drv = drv, maxradius = 40, max = 30'),
	'things_2' => array('things' => 'drv = drv, max = '.rand()%60),
	'things_5' => array('things' => 'drv = drv, max = '.rand()%60),
	'circles_2' => array('circles' => 'drv = drv, maxradius = 30, max = 500'),
	'test_1' => array('test' => 'drv = drv, max = '.rand()%60),
	'rectangles_1' => array('rectangles' => 'drv = drv, max = 20, minx = 300, miny = 200')
);

asort($canvasFunctionsRun);

function getPageHTML()
{
	$output = '';

	$output .= '<!DOCTYPE html>';
	$output .= '<html>';
		$output .= '<head>';

		$output .= '<style>';
			$output .= 'canvas { border: '.(rand()%5).'px solid #000;}';
		$output .= '</style>';

		$output .= '<body>';

			$output .= '<canvas id="'.CANVAS_NAME.'" width="'.CANVAS_MAX_X.'" height="'.CANVAS_MAX_Y.'">';
				$output .= 'herp derp nice browser';
			$output .= '</canvas>';

			$output .= '<script>';
				$output .= getPageJS();
			$output .= '</script>';

		$output .= '</body>';

	$output .= '</html>';

	return $output;
}

function parseVariables(&$variables)
{
	$variables = explode(', ', $variables);
	foreach($variables as $variable => $val)
	{
		$xvar = strstr($val, ' ', true);
		$xval = ltrim(strrchr($val, ' '), ' ');
		$xvariables[$xvar] = addslashes($xval);
	}

	$variables = $xvariables;
}

function rectangles($variables)
{
	parseVariables($variables);

	$output = '';

	$output .= <<< 'EOD'

	for(i = 0; i < max; i++)
	{
		drv.fillStyle = 'rgba('+Math.round(Math.random()*256)+','+Math.round(Math.random()*256)+','+Math.round(Math.random()*256)+',1)';

		if(Math.round(Math.Random())%2)
		{
			drv.fillRect(minx, miny, Math.random()*120, Math.random()*90);
		}
		else
		{
			drv.clearRect(minx, miny, Math.random()*120, Math.random()*90);
		}
	}

EOD;

	return $output;
}

function circles($variables)
{
	parseVariables($variables);

	$output = '';

	$output .= <<< 'EOD'

	for(i = 0; i < max; i++)
	{
		randcolor1 = Math.round(Math.random()*16).toString(16);
		randcolor2 = Math.round(Math.random()*16).toString(16);
		randcolor3 = Math.round(Math.random()*16).toString(16);
		randcolor4 = Math.round(Math.random()*16).toString(16);
		randcolor5 = Math.round(Math.random()*16).toString(16);
		randcolor6 = Math.round(Math.random()*16).toString(16);

		drv.strokeStyle = '#'+randcolor1+randcolor2+randcolor3+randcolor6+randcolor5+randcolor4;
		drv.fillStyle = '#'+randcolor4+randcolor5+randcolor6+randcolor3+randcolor2+randcolor1;
		drv.beginPath();
		drv.arc(Math.round(Math.random()*MAX_X_4+MAX_X_2),Math.round(Math.random()*MAX_Y_4+MAX_Y_2),Math.round(Math.random()*maxradius),0+Math.random()*50,Math.PI+Math.random()*37,true);
		drv.closePath();

		if(Math.round(Math.random()*50)%2 == 1)
		{
			drv.stroke();
		}
		else if(Math.round(Math.random()*50)%2 == 1)
		{
			drv.fill();
		}
	}

EOD;

	return $output;
}

function test($variables)
{
	parseVariables($variables);

	$output = '';

	$output .= <<< 'EOD'

	drv.moveTo(Math.round(Math.random()*CANVAS_MAX_X), Math.round(Math.random()*CANVAS_MAX_Y));

	for(i = 0; i < max; i++)
	{
		x = Math.random()*CANVAS_MAX_X;
		y = Math.random()*CANVAS_MAX_Y;
		dx = (Math.random()%2)?(x+Math.random()*CANVAS_MAX_X)%CANVAS_MAX_X:(x-Math.random()*CANVAS_MAX_X)%CANVAS_MAX_X;
		dy = (Math.random()%2)?(y+Math.random()*CANVAS_MAX_Y)%CANVAS_MAX_Y:(y-Math.random()*CANVAS_MAX_Y)%CANVAS_MAX_Y;

		drv.lineTo(Math.round(dx), Math.round(dy));
	}

EOD;

	return $output;
}

function things($variables)
{
	parseVariables($variables);

	$output = '';

	$output .= <<< 'EOD'

	drv.moveTo(Math.round(Math.random()*MAX_X_4+MAX_X_2), Math.round(Math.random()*MAX_Y_4+MAX_Y_2));

	for(i = 0; i < max; i++)
	{
		x = Math.random()*MAX_X_4;
		y = Math.random()*MAX_Y_4;
		dx = (((x + y)%2) == 0)?(x+Math.random()*MAX_X_2)%CANVAS_MAX_X:(x-Math.random()*MAX_X_2)%CANVAS_MAX_X;
		dy = (x > y)?(y+Math.random()*MAX_Y_2)%CANVAS_MAX_Y:(y-Math.random()*MAX_Y_2)%CANVAS_MAX_Y;

		randcolor1 = Math.round(Math.random()*16).toString(16);
		randcolor2 = Math.round(Math.random()*16).toString(16);
		randcolor3 = Math.round(Math.random()*16).toString(16);
		randcolor4 = Math.round(Math.random()*16).toString(16);
		randcolor5 = Math.round(Math.random()*16).toString(16);
		randcolor6 = Math.round(Math.random()*16).toString(16);

		drv.fillStyle = '#'+randcolor1+randcolor2+randcolor3+randcolor4+randcolor5+randcolor6;

		if(Math.round(Math.random()*50)%2 == 1)
		{
			drv.lineTo(Math.round(dx), Math.round(dy));
		}
		else if(Math.round(Math.random()*50)%2 == 1)
		{
			drv.stroke(Math.round(dx), Math.round(dy));
		}
		else
		{
			drv.fill();
		}
	}

EOD;

	return $output;
}

function getPageJS()
{
	global $canvasFunctionsDefine;
	global $canvasFunctionsRun;

	$outputJS = '';

	$outputJS .= 'var CANVAS_MAX_X = '.CANVAS_MAX_X.';';
	$outputJS .= 'var CANVAS_MAX_Y = '.CANVAS_MAX_Y.';';
	$outputJS .= 'var CANVAS_NAME = \''.CANVAS_NAME.'\';';

	$outputJS .= <<< 'EOD'

var x;
var y;
var dx;
var dy;

var randcolor1;
var randcolor2;
var randcolor3;
var randcolor4;
var randcolor5;
var randcolor6;

var MAX_X_2 = CANVAS_MAX_X/2;
var MAX_Y_2 = CANVAS_MAX_Y/2;
var MAX_X_4 = CANVAS_MAX_X/4;
var MAX_Y_4 = CANVAS_MAX_Y/4;

var canvas = document.getElementById(CANVAS_NAME);

if(canvas.getContext)
{
	var drv = canvas.getContext("2d");
	drv.beginPath();

EOD;

	foreach($canvasFunctionsRun as $canvasFunction => $variables)
	{
		$outputJS .= strstr($canvasFunction, '_', true).'(';
		foreach(explode(', ', $variables[strstr($canvasFunction, '_', true)]) as $variable)
		{
			$outputJS .= ltrim(strrchr($variable, ' '), ' ').', ';
		}
		$outputJS = rtrim($outputJS, ', ');
		$outputJS .= ');';
	}

	foreach($canvasFunctionsDefine as $canvasFunction => $variables)
	{
		$outputJS .= 'function '.$canvasFunction.'(';
		foreach(explode(', ', $variables) as $variable)
		{
			$outputJS .= strstr($variable, ' ', true).', ';
		}
		$outputJS = rtrim($outputJS, ', ');
		$outputJS .= '){';

		$outputJS .= $canvasFunction($variables);

		$outputJS .= '}';
	}

$outputJS .= '}';

	if(!DEVEL)
	{
		getPackedJS($outputJS);
	}

	return $outputJS;
}


if('DEFAULT' == 'DEFAULT')
{
	$output = '';

	$output .= getPageHTML();

	echo $output;
}

function getPackedJS(&$strJS)
{
        require_once('class.JavaScriptPacker.php');

        $myPacker = new JavaScriptPacker($strJS, 'High ASCII', true, false);
        $strJS = $myPacker->pack();

        $strJS = rtrim($strJS);
}

?>
