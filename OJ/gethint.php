<!DOCTYPE html>
<html>
	<head>
		<style>
			.class1 #id1:link, .class2 #id2:link, .class3 #id3:link, .class1 #id1:hover, .class2 #id2:hover, .class3 #id3:hover, .class1 #id1:active, .class2 #id2:active, .class3 #id3:active {}
			{.class1 #id1, .class2 #id2, .class3 #id3}:focus,:hover,:link,:visited {
				color: green;
			}
		</style>
	</head>
	<body>
		<div class="class1">
 			<a id="id1" href="#">1</a>
 		</div>
 		<div class="class2">
 			<a id="id2" href="#">2</a>
 		</div>
 		<div class="class3">
 			<a id="id3" href="#">3</a>
 		</div>
 		<div class="class4">
 			<a id="id4" href="#">4</a>
		</div>
	</body>
</html>
