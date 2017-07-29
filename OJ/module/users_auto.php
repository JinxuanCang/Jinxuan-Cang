<script>
	function AutoLogoff() {window.open("../login","_top");}
</script>
<?php if (!isset($_SESSION['username']) or $_SESSION['username']=="" or $_SESSION['username']==null) { ?>
  <script>
    AutoLogoff();
  </script>
<?php $_SESSION["logstatu"] = "No";} ?>