<?php
//board.php
require_once("header.php");
$board_data = array();
$sql = "SELECT * FROM board ORDER BY created_at DESC";
if( $rs = $db->query($sql) ) {
	$board_data = $rs->fetchAll();
}
?>
<h1 class="mt-5">게시판</h1>
<p class="text-end">
	<button class="btn-write btn btn-primary">
		<i class="fas fa-pen"></i>
		글쓰기
	</button>
</p>
<div id="form-box" class="mb-5">
	<form action="action.php" method="post">
		<input type="hidden" name="action" value="addpost">
		<div class="form-group">
			<label for="title">제목</label>
			<input type="text" name="title" id="title" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="content">내용</label>
			<textarea name="content" id="content" rows="10" class="form-control" required></textarea>
		</div>
		<button type="submit" class="btn btn-success btn-lg mt-3">
			<i class="fas fa-save"></i>
			글등록
		</button>
		<button class="btn-x btn btn-dark btn-lg mt-3">
			<i class="fas fa-times"></i>
			닫기
		</button>
	</form>
</div>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Created At</th>
			<th>User Id</th>
			<th>hit</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($board_data as $row):?>
		<tr>
			<td><?=$row['id']?></td>
			<td>
				<a href="boardview.php?id=<?=$row['id']?>">
				<?=$row['title']?>
				</a>
			</td>
			<td><?=$row['created_at']?></td>
			<td><?=$row['user_id']?></td>
			<td><?=$row['hit']?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php
require_once("footer.php");