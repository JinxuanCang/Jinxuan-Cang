<html>
  <head>
    <?php
      include("../essential_settings.php");
      Initialize();
      js("../js/encrypt.js")
    ?>
    <style>
      #username,#password {
        width: 210px;
        height: 25px;
      }
    </style>
  </head>
  <body>
	<div id="mainbody">
    <fieldset class="info">
      <h2>Please Sign In</h2>
      <p>By visiting this online software product, each visitor automatically agrees the <a onclick="window.open('/terms_of_service','_blank', 'height=570,width=520')">Terms of Service</a> and promises not to violate any of its policy.</p>
    </fieldset>
    <fieldset class="form">
      <legend>Login</legend>
      <label for="username">Username</label>
      <input type="text" id="username" placeholder="Entire Name/ID" autofocus>
      <label for="password">Password</label>
      <input type="password" id="password">
      <button id="login_submit" onclick="Request_Login()" disabled>Go</button><br>
      <span id="login_responder">Please enter your access information above. This product should be accessed by authorized personnel only.</span>
    </fieldset>
	</div>
  <script>
    var error_level = ["username_nc","password_nc"];
    invoke("username").oninput = function() {
      error_level.remove("rs_WU");
      Request_Test();
    }
    invoke("password").oninput = function() {
      error_level.remove("rs_WP");
      Request_Test();
    }
    function Request_Test() {
      var login_username = invoke("username").value;
      var login_password = invoke("password").value;
      if (login_username==""||login_username==undefined) {
        if(!error_level.includes("username_nc",-100))
          error_level.unshift("username_nc");
      }
      else error_level.remove("username_nc");
      if (login_password==""||login_password==undefined) {
        if(!error_level.includes("password_nc",-100))
          error_level.unshift("password_nc");
      }
      else error_level.remove("password_nc");
      
      if ((XOR(!login_username.checkLls(),login_username.checkLn()))&& !(login_username==""||login_username==undefined)) {
        if (!error_level.includes("username_ctni",-100))
          error_level.unshift("username_ctni");
      }
      else error_level.remove("username_ctni");
      if (!login_password.checkLln()) {
        if (!error_level.includes("password_ctni",-100))
        error_level.unshift("password_ctni");
      }
      else error_level.remove("password_ctni");
      Post_Warning();
    }
    function Post_Warning() {
      var string = "login_responder";
      invoke(string).redFont();
      if(error_level.includes("username_ctni",-100)||error_level.includes("rs_WU",-100))
        invoke("username").classList.add("redbox");
      else
        invoke("username").classList.remove("redbox");
      if(error_level.includes("password_ctni",-100)||error_level.includes("rs_WP",-100))
        invoke("password").classList.add("redbox");
      else
        invoke("password").classList.remove("redbox");
      if(error_level.length!=0) invoke("login_submit").disable();
      else invoke("login_submit").enable();
      vartext(string,"");
      for (var i = 0; i < error_level.length; i++)
        switch(error_level[i]) {
          case "username_ctni":addtext(string,"Username only consists entirely letters or entirely numbers. ");break;
          case "password_ctni":addtext(string,"Password only consists letters and/or numbers. ");break;
          case "rs_WP":addtext(string,"Password incorrect. ");break;
          case "rs_WU":addtext(string,"Unknown Username. ");break;
          case "rs_UA":window.open("/forbidden/Unathorized%20Action(UA)");break;
          case "rs_SF":addtext(string,"Your privilege standard is rejected to sign in. ");break;
          case "rs_MN":addtext(string,"Please use your entire name to sign in. ");break;
          case "rs_FR":addtext(string,"Your account status is rejected to sign in. ");break;
          default:break;
        }
      if ((error_level.length==2&&error_level.includes("username_nc")&&error_level.includes("password_nc"))||(error_level.length==1&&(error_level.includes("username_nc")||error_level.includes("password_nc")))|| error_level.length==0) {
        vartext(string,"Please enter your access information above. This product should be accessed by authorized personnel only.");
        invoke(string).blackFont();
      }
    }
    function Request_Login(){
      if(invoke("login_submit").disabled!=true) {
        loginAJAX("username="+invoke("username").value+"&password="+SHA1(invoke("password").value))
        login.onreadystatechange = function() {
          if (this.readyState==4 && this.status==200) {
            var string = "login_responder";
            var response = this.responseText.split(" ");
            if (response[0]!="LI") {
              error_level.unshift("rs_"+response[0]);
              Post_Warning();
            }
            else {
              window.parent.userPrivilege = response[3];
              console.log(response[5]);
              
              window.parent.window["detailPrivilege"]["gnrl"] = response[5];
              window.parent.window["detailPrivilege"]["asgmt"] = response[6];
              //window.parent.window["detailPrivilege"]["apps"] = new Array(response[7]);
              //if(response[3]=="WebsiteDebugger") window.parent.valid("gnrl_scpts");
              window.parent.LoggedIn();
              window.parent.invoke("account").children[0].innerHTML = response[2].replace("_"," ");
            }
          }
        }
      }
    }
    window.onkeydown = function() {
      if(invoke("password")===document.activeElement&&window.event.keyCode==13&&invoke("login_submit").disabled!=true) Request_Login();
    }
  </script>
  <?php AJAX("login","POST","../module/login_users.php"); ?>
  <?php if(isset($_SESSION["username"])) { ?>
        <script>
          vartext("login_responder",'<?php echo str_replace("_", " ", $_SESSION["username"]);?> logged off.');
          invoke("login_responder").blueFont();
          setTimeout(function() {
            if ((error_level.length==2&&error_level.includes("username_nc",-100)&&error_level.includes("password_nc",-100))||error_level.length==0) {
              vartext("login_responder","Please enter your access information above. This product should be accessed by authorized personnel only.");
              invoke("login_responder").blackFont();
            }
          },5000)
        </script>
  <?php
        unset($_SESSION["username"]); }
  ?>
  </body>
</html>