<?php
//boardedit.php?id=1 GET
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
?>
<h1 class="mt-5">글수정</h1>
<div class="mb-5">
	<form action="action.php" method="post">
		<input type="hidden" name="action" value="editpost">
		<input type="hidden" name="id" value="<?=$id?>">
		<div class="form-group">
			<label for="title">제목</label>
			<input type="text" name="title" id="title" class="form-control" required value="<?=$title?>">
		</div>
		<div class="form-group">
			<label for="content">내용</label>
			<textarea name="content" id="content" rows="10" class="form-control" required><?=$content?></textarea>
		</div>
		<button type="submit" class="btn btn-warning mt-3">
			<i class="fas fa-save"></i>
			글저장
		</button>
		<a href="/board.php" class="btn btn-success mt-3">
			<i class="fas fa-list"></i>
			목록으로
		</a>
	</form>
</div>

<p class="mb-5">&nbsp;</p>
<?php
require_once("footer.php");