/* 
	J.C.'s Online Software (c) 2017
    PHP-Campus Version 3.3
    Convert Colorcodes function library.
    Not every individual .php(extension) file requires this library.
    Programmer: Jinxuan Cang
*/
//initial should be a char, however if it detects a string, the function will automaticly trim the rest of the string.
function initial_colorcode(string) {
  var initial = string.substr(0, 1);
  switch (initial) {
    case 'A': return "blue"; break;
    case 'B': return "rgb(175,13,102)"; break;
    case 'C': return "greenyellow"; break;
    case 'D': return "rgb(255,200,47)"; break;
    case 'E': return "orange"; break;
    case 'F': return "lightgray"; break;
    case 'G': return "rgb(235,235,222)"; break;
    case 'H': return "gray"; break;
    case 'I': return "yellow"; break;
    case 'J': return "rgb(55,19,112)"; break;
    case 'K': return "rgb(255,255,150)"; break;
    case 'L': return "rgb(202,62,94)"; break;
    case 'M': return "darkorange"; break;
    case 'N': return "teal"; break;
    case 'O': return "red"; break;
    case 'P': return "rgb(175,155,50)"; break;
    case 'Q': return "black"; break;
    case 'R': return "darkgreen"; break;
    case 'S': return "purple"; break;
    case 'T': return "rgb(83,140,208)"; break;
    case 'U': return "green"; break;
    case 'V': return "cyan"; break;
    case 'W': return "pink"; break;
    case 'X': return "darkblue"; break;
    case 'Y': return "rgb(175,200,74)"; break;
    case 'Z': return "rgb(63,25,12)"; break;
  }
}