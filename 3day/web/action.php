<?php
//action.php
require_once("config.php");
$action = isset($_POST['action']) ? $_POST['action'] : "";
$title = isset($_POST['title']) ? $_POST['title'] : "";
$content = isset($_POST['content']) ? $_POST['content'] : "";
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$title = htmlspecialchars($title);
$content = htmlspecialchars($content);
if( $action == "addpost" ) {
	if( $title && $content ) {
		$file = "";
		if( is_uploaded_file($_FILES['file']['tmp_name']) ) {
			$upfolder = "./uploads/";
			$filename = basename($_FILES['file']['name']);
			$target = $upfolder . $filename;
			if( move_uploaded_file($_FILES['file']['tmp_name'], $target) ) {
				$file = $filename;
			}
		}
		$sql = "INSERT INTO board(title, content, file, created_at, user_id, hit) VALUES(:title, :content, :file, now(), 0, 0)";
		if( $rs = $db->prepare($sql) ) {
			$rs->bindParam(":title", $title);
			$rs->bindParam(":content", $content);
			$rs->bindParam(":file", $file);
			$rs->execute();
		}
	}
	header("Location: /board.php");
} else if($action == "delpost") {
	$result = array("success"=>false, "msg"=>"삭제실패");
	if( $id ) {
		$sql = "DELETE FROM board WHERE id=:id";
		if( $rs = $db->prepare($sql) ) {
			$rs->bindParam(":id", $id);
			if( $rs->execute() ) {
				if( $rs->rowCount() ) {
					$result['success'] = true;
					$result['msg'] = "삭제성공";
				}
			}
		}
	}
	echo json_encode($result);
} else if($action == "editpost" ) {
	if( $id && $title && $content ) {
		$sql = "UPDATE board SET title=:title, content=:content WHERE id=:id";
		if( $rs = $db->prepare($sql) ) {
			$rs->bindParam(":title", $title);
			$rs->bindParam(":content", $content);
			$rs->bindParam(":id", $id);
			$rs->execute();
		}
	}
	header("Location: /boardview.php?id=".$id);
}