<?php
//suppress E Notice errors
error_reporting(E_ALL & ~E_NOTICE);
?>
<!Doctype html>

<html lang="en">
<head>
<title>Snek Name Generator</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
<?php
function randomUnicodeStr($nameLen) {
	
	//init snek string
	$firstChar = rand(0,5);
	
	switch($firstChar) {
		case 0:
			$varSnek = "S";
			break;
		case 1:
			$varSnek = "Sh";
			break;
		case 2:
			$varSnek = "X";
			break;
		case 3:
			$varSnek = "Xí";
			break;
		case 4:
			$varSnek = "Ts";
			break;
		case 5:
			$varSnek = "Ch";
			break;
	}
		
		//Generate loop
        for ($i = 0; $i < $nameLen; $i++) {
			
			//Alphabet select
			$caseX = rand(0,5);
			
			switch ($caseX) {
				case 0:	//Basic Latin
					$uniNum = mt_rand(0x0021, 0x007E);
					break;
				
				case 1:	//Basic Latin 2
					$uniNum = mt_rand(0x00A1, 0x00FF);
					break;
					
				case 2:	//Katakana
					$uniNum = rand(0x30A0, 0x30FF);
					break;
					
				case 3:	//Hiragana
					$uniNum = rand(0x3041, 0x3096);
					break;
				
				case 4:	//Cyrillic
					$uniNum = rand(0x0400, 0x04FF);
					break;
				
				case 5:	//Greek and Coptic
					$uniNum = rand(0x03A3, 0x03FF);
					break;
			}
			
			//concat random unicode char to snek string
			$uniChar = '\u'.sprintf('%04x',$uniNum);
            $varSnek .= json_decode('"'.$uniChar.'"');
        }
	
	//finish snek string
	$lastChar = rand(0,3);
	$i2 = 0;
	
	switch($lastChar) {
		case 0:
			$varSnek .= "N";
			break;
		case 1:
			$varSnek .= "n";
			break;
		case 2:
			$varSnek .= "ne";
			break;
		case 3:
			$numNs = rand(1,3);
			
			for($i2=0;$i2 <= $numNs;$i2++){
				$caps = rand(0,1);
				
				if($caps == 0){
					$varSnek .= "N";
				}
				else {
					$varSnek .= "n";
				}
			}
			
			break;
	}
	
	//return
	return $varSnek;
}


//UI
echo '<div class="wrapper">';

echo '<h1>Snek Name Generator</h1>';

echo '<div class="leftContainer">';

echo '<form action="snekGen.php" method="post">';

if($_POST['nameLen']){
	$prevLen = $_POST['nameLen'];
	echo '<label for="nameLen">Enter length of the name: </label><input type="number" name="nameLen" id="nameLen" value="'.$prevLen.'"><br><br>';
}
else{
	echo '<label for="nameLen">Enter length of the name: </label><input type="number" name="nameLen" id="nameLen" value="2"><br>';
}

echo '<button type="submit" name="randStrUni" value="true">Generate!</button>';

echo '</form>';

echo '<h2>Results</h2>';

if($_POST['randStrUni'] == true){
	
	$nameLen = $_POST['nameLen'];
	
	if($nameLen > 1000 || $nameLen < -1000){
		echo '<p>I gotta put a limit somewhere, so I picked 1,000. Large numbers will cause the code to time-out. What the hell are you doing to do with a string longer than 1,000 characters anyway other than be an asshole?</p>';
	}
	else {
		echo '<p class="resultPane">'.randomUnicodeStr($nameLen).'</p>';
	}	
}

echo '</div>';

echo '<figure><img src="images/Top-Shun.jpg" alt="Awesome Picture of Snek"><figcaption>artist: Travis Pruitt<br>source: thedickshow.com/fan-art</figcaption></figure>';

echo '</div>';
?>
</body>
</html>