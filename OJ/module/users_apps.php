<?php
	/* This is the users' application module.*/
	#distributing task

	switch ($_GET["app"]) {
		case 'stat':
			goto stat;
			break;
		case 'freeze_user':
		    goto freeze_user;
		    break;
		case 'restore_user':
		    goto restore_user;
		    break;
		default:
			# code...
			break;
	}
	exit;

	#statistics application
	stat:
	$path = "../users/";
	$user_ID = scandir($path);
	#reset all user categories quantities
    $s_admin = 0;
    $admin = 0;
    $teacher = 0;
    $student = 0;
    $parent = 0;
    $fr_act = 0;
	foreach ($user_ID as $key => $value) {
		if ($value=="." || $value==".." || $value=="name_convert"):
            continue;
        endif;
        $user_info = file($path.$value."/info");
        $user_cate = trim($user_info[1]);
        
        switch ($user_cate) {
        	case 'SuperAdministrator':
        		$s_admin++;
        		break;
        	case 'Administrator':
        		$admin++;
        		break;
        	case 'Teacher':
        		$teacher++;
        		break;
        	case 'Student':
        		$student++;
        		break;
        	case 'Parent':
        		$parent++;
        		break;
        	default:
        		# code...
        		break;
        }
        if (file_exists($path.$value."/freezing")) {
        	$fr_act++;
        }
	}
	echo "[t_users]";
	echo count($user_ID)-3;
	echo "[s_admin]";
	echo $s_admin;
	echo "[admin]";
	echo $admin;
	echo "[teacher]";
	echo $teacher;
	echo "[student]";
	echo $student;
	echo "[parent]";
	echo $parent;
	echo "[fr_act]";
	echo $fr_act;
	echo "[end]";
	#done
	exit;
	freeze_user:
	$user_id = $_GET["id"];
	$path = "../users/";
	$user_dir = fopen($path.$user_id."/freezing", "w");
    fwrite($user_dir, "");
    fclose($user_dir);
	#done
	exit;
	restore_user:
	$user_id = $_GET["id"];
	$path = "../users/";
	unlink($path.$user_id."/freezing");
	#done
	exit;
?>