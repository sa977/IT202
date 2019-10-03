<html>
<head>
<!--css and javascript here (this is a comment. // still works too)-->
<script>
function pageLoaded(){

//alert("Hello World");
var myVariable;
let myOtherVariable;
//myVariable = prompt("What's your name?");
//alert("Helloooooo, " + myVariable);  //'.'(dot) is used to concatenate in php but '+' (plus) works for js

let myNum = 0;
for(let i = 0; i < 10; i++){
	myNum += 0.1;
}
//alert("My Num is 1: " + (myNum == 1) + "\nMy Num: " + myNum);
console.log("My Num is 1: " + (myNum == 1) + "\nMyNum: " +myNum);

	let myParagraph = document.getElementById("myParagraph");
	console.log(myParagraph);
	myParagraph.innerText = "It was updated";
}
</script>
</head>

<body onload="pageLoaded();console.log('loaded')">
<!-- html content -->
<p id= "myParagraph">It loaded, yay!</p>
<div style = "background-color:lightblue">
	<p>New element added.</p>
</div>
</body>
</html>
