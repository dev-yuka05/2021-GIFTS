<?php
//boardview.php?id=1 GET
require_once("header.php");
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$title = "";
$content = "";
$file = "";
$user_id = 0;
$hit = 0;
$created_at = "";
if( $id ) {
	$sql = "SELECT * FROM board WHERE id=:id";
	if( $rs = $db->prepare($sql) ) {
		$rs->bindParam(":id", $id);
		if( $rs->execute() ) {
			if( $data = $rs->fetch() ) {
				$title = $data['title'];
				$content = $data['content'];
				$file = $data['file'];
				$user_id = $data['user_id'];
				$hit = $data['hit'];
				$created_at = $data['created_at'];
			}
		}
	}
}
$filelink = "";
if( $file ) {
	$path = "./uploads/" . $file;
	if( file_exists($path) ) {
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		if( $ext == "jpg" || $ext == "gif" || $ext == "png" ) {
			$filelink = "<img src='{$path}' style='max-width: 100%;   border: 1px solid #000; border-radius: 5px;'>";
		} else {
			$filelink = "<a href='{$path}'>{$file}</a>";
		}
	}
}

?>
<h1 class="mt-5">글보기</h1>
<h3><?=$title?></h3>
<hr>
<p>
	날짜: <?=$created_at?> 
	조회: <?=$hit?> 
	글쓴이: <?=$user_id?>
</p>
<hr>
<p class="mb-5"><?=nl2br($content)?></p>
<p><?=$filelink?></p>
<a href="/board.php" class="btn btn-success">
	<i class="fas fa-list"></i>
	목록으로
</a>
<a href="/boardedit.php?id=<?=$id?>" class="btn btn-warning">
	<i class="fas fa-edit"></i>
	수정
</a>
<a href="<?=$id?>" class="board-del btn btn-danger">
	<i class="fas fa-trash"></i>
	삭제
</a>
<p class="mb-5">&nbsp;</p>
<?php
require_once("footer.php");