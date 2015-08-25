 /* -- jQuery Colourific */
 /* -- v 1.0 - January 2008 */
 /* -- by ben watts (http://www.benwatts.ca/sandbox/jquery-colourific/) */
 
 $(document).ready(function(){
	 changeColour($('div.content'));
 });
 
 // changeColour
 function changeColour(e){
  	
 	// random values between 0 and 255, these are the 3 colour values
 	var r = Math.floor(Math.random()*256);
 	var g = Math.floor(Math.random()*256);
 	var b = Math.floor(Math.random()*256);
 	
 	// change the text colour of this element
 	e.css("border-top-color", getHex(r,g,b));
 	
 }
  
 // intToHex()
 function intToHex(n){
 	n = n.toString(16);
 	// eg: #0099ff. without this check, it would output #099ff
 	if( n.length < 2) 
 		n = "0"+n; 
 	return n;
 }
 
 // getHex()
 // shorter code for outputing the whole hex value
 function getHex(r, g, b){
 	return '#'+intToHex(r)+intToHex(g)+intToHex(b); 
 }