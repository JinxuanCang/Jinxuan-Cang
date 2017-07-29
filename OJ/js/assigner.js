invoke("new_assign_name").oninput = function() {
	var assign_name = invoke("new_assign_name").value.trim();
	var assign_abbr = assign_name[0];
	for (i = 1; i<assign_name.length-1; i++)
		if((assign_name[i]!=" "&&assign_name[i-1]==" ")||(assign_name[i]!="_"&&assign_name[i-1]=="_"))
			assign_abbr+=assign_name[i];
	if (assign_name.length!=1)
		assign_abbr += assign_name[assign_name.length-1];
	if (assign_name.length==0)
		assign_abbr = "Invalid";
	else {
		assign_abbr = assign_abbr.replace(/_/g,"");
		assign_abbr = assign_abbr.replace(/ /g,"");
	}
	if (assign_abbr.length==0)
		assign_abbr = "Invalid"
	vartext("new_assign_abbr_sug",assign_abbr);
}
invoke("new_assign_abbr").ondblclick = function() {
	if (invoke("new_assign_abbr_sug").innerHTML!="Invalid")
		invoke("new_assign_abbr").value = invoke("new_assign_abbr_sug").innerHTML;
}