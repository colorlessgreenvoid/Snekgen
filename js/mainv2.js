function unicodeRandStr(nameLen) {
	//var init
	let varLen = nameLen;
	let firstChar = Math.floor((Math.random() * 6));
	let i = 0;
	
	switch(firstChar) {
		case 0:
			var varSnek = "S";
			break;
		case 1:
			var varSnek = "Sh";
			break;
		case 2:
			var varSnek = "X";
			break;
		case 3:
			var varSnek = "Xí";
			break;
		case 4:
			var varSnek = "Ts";
			break;
		case 5:
			var varSnek = "Ch";
			break;
	}
	
	//Gen Loop
	for(i=0;i < nameLen; i++){
		
		//alphabet select
		//formula for calculating random value between two numbers:
		//(randomFunction * (Max - min)) + min
		//Unicode hex values were converted to dec for random function
		//They are converted back to hex afterwards, and pre-fixed with \u
		let caseX = Math.floor((Math.random() * 6));
		
		switch(caseX) {
				case 0:	//Basic Latin
					var uniNum = Math.floor(Math.random() * (127-33)) + 33;
					//0x0021, 0x007E
					break;
				
				case 1:	//Basic Latin 2
					var uniNum = Math.floor(Math.random() * (256-161)) + 161;
					//0x00A1, 0x00FF
					break;
					
				case 2:	//Katakana
					var uniNum = Math.floor(Math.random() * (12544-12448)) + 12448;
					//0x30A0, 0x30FF
					break;
					
				case 3:	//Hiragana
					var uniNum = Math.floor(Math.random() * (12439-12353)) + 12353;
					//0x3041, 0x3096
					break;
				
				case 4:	//Cyrillic
					var uniNum = Math.floor(Math.random() * (1280-1024)) + 1024;
					//0x0400, 0x04FF
					break;
				
				case 5:	//Greek and Coptic
					var uniNum = Math.floor(Math.random() * (1024-931)) + 931;
					//0x03A3, 0x03FF
					break;
			}
			
			//create unicode char string from uniNum
			var uniStr= uniNum.toString(16);
			
			//Padd unicode hex value with 0s if needed
			while(uniStr.length < 4){
				uniStr = "0" + uniStr;
			}
			
			//create unicode escape char string
			var uniChar = "\\u"+uniStr;
			
			uniChar = JSON.parse('"'+uniChar+'"');
			
			varSnek = varSnek + uniChar;
	}
	
	//finish snek string
	let lastChar = Math.floor((Math.random() * 4));
	let i2 = 0;
	
	switch(lastChar) {
		case 0:
			varSnek = varSnek +"N";
			break;
		case 1:
			varSnek = varSnek +"n";
			break;
		case 2:
			varSnek = varSnek +"ne";
			break;
		case 3:
			numNs = Math.floor((Math.random() * 3)+1);
			
			for(i2=0;i2 <= numNs;i2++){
				caps = Math.floor((Math.random() * 2));
				
				if(caps == 0){
					varSnek = varSnek +"N";
				}
				else {
					varSnek = varSnek +"n";
				}
			}
			
			break;
	}
	
	return varSnek;
}

$(document).ready(function() {

	$("button.snekGenBtn").click(function() {
		let nameLen = $("#nameLen").val();
		
		if(nameLen > 1000 || nameLen < -1000){
			$("p.resultPane").empty();
			
			$("p.resultPane").append("I put the limit at 1000 because it's a reasonable number. Too large of a Snek names will crash the program.");
		}
		else {
			$("p.resultPane").empty();
		
			$("p.resultPane").append(unicodeRandStr(nameLen));
		}
	});
	
});