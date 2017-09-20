<div style="
    background: #111;
    position: absolute;
    right: 10px;
    top: 82px;
    z-index: 2;
    padding: 10px;
    font-size: 12px;
    width: 170px;
" class="" id="account_notification"><div id="account_notification_header">New Feature!</div>
<div>Hover on the the user name and view your account detail.</div>
<div>Required action(s) will be posted via this feature.</div></div>
<style>
	div#account_notification::before {
    content: "";
    position: absolute;
    top: -10px;
    left: 82px;
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 10px solid black;
}
div#account_notification_header {
    font-size: 17px;
    color: yellow;
    margin-bottom: 5px;
   }

</style>