<?php
//board.php
require_once("header.php");
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if( ! $page ) $page = 1;
$board_data = array();
$total = 0; //전체 글 수
$pageset = 10; // 한 페이지에 보여줄 목록 수
$blockset = 10; // 페이지 버튼 수
$sql = "SELECT * FROM board";
if( $rstmp = $db->query($sql) ) $total = $rstmp->rowcount();
if( $total ) {
	$start = ($page - 1) * $pageset;
	$sql .= " ORDER BY created_at DESC LIMIT {$start}, {$pageset}";
	if( $rs = $db->query($sql) ) $board_data = $rs->fetchAll();
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
	<form action="action.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="addpost">
		<div class="form-group">
			<label for="title">제목</label>
			<input type="text" name="title" id="title" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="content">내용</label>
			<textarea name="content" id="content" rows="10" class="form-control" required></textarea>
		</div>
		<div class="form-group">
			<label for="title">첨부</label>
			<input type="file" name="file" id="file" class="form-control">
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
			<th>File</th>
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
			<td>
				<?php
					$icon = "";
					if( $row['file'] ) {
						$path = "./uploads/" . $row['file'];
						if( file_exists($path) ) {
							$ext = pathinfo($path, PATHINFO_EXTENSION);
							$ext = strtolower($ext);
							if( $ext == "jpg" || $ext == "gif" || $ext == "png" ) {
								$icon = "<i class='fa fa-file-image'></i>";
							} else {
								$icon = "<i class='fa fa-file'></i>";
							}
							$icon = "<a href='{$path}'>{$icon}</a>";
						}
					}
					echo $icon;
				?>
			</td>
			<td><?=$row['hit']?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<p><?=pagination($total, $pageset, $blockset, $page)?></p>
<?php
require_once("footer.php");