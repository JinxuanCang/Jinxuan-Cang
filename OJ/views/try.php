<html>
<body>
<?php
  $var = 10; 
?>
<script type="text/javascript">
    function solve() {
    	document.write("<?php $var = 100;?>");
    	document.write("<?php echo $var;?>");
    }
	//document.write("<?php echo $var;?>");
</script>
<button onclick="solve();">Click me</button>
</body>
</html>