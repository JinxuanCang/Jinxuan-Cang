function Freeze_User(id,name) {
	var pre = "<button onclick='HideMessage();'>Cancel</botton><button onclick='AJAX_Execute("+id+");'>Continue</button>";
	LoadMessage("Caution","You are going to freeze user <b>"+id+" "+name+"</b>. "+pre);
    execute_action = "freeze_user"
}
function Restore_User(id,name) {
	var pre = "<button onclick='HideMessage();'>Cancel</botton><button onclick='AJAX_Execute("+id+");'>Continue</button>";
	LoadMessage("Caution","You are going to restore user <b>"+id+" "+name+"</b>. "+pre);
	execute_action = "restore_user"
}
function AJAX_Execute(id) {
	Loading();
	/* AJAX Setup Line Begins */
    var user_exe=new XMLHttpRequest();
    user_exe.onreadystatechange=function() {
    if (user_exe.readyState==4 && user_exe.status==200) {
        AJAX_Switch_Order(current_sort_item,current_sort_sequence)
    }
    else if (user_exe.readyState==4 && user_exe.status!=200){
            LoadMessage("Error","XML Http Request failed. Response detail: <b>"+user_exe.status+": "+user_exe.statusText+"</b>.");
        }
    }
    //AJAX Sending
    user_exe.open("GET","../module/users_apps.php?app="+execute_action+"&id="+id,true);
    user_exe.send();
    /* AJAX Setup Line Ends*/

}