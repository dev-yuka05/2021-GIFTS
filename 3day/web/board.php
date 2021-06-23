<?php
require_once("header.php");
$board_data = array();
$sql = "SELECT * FROM board ORDER BY created_at DESC";
if( $rs = $db->query($sql) ) {
	$board_data = $rs->fetchAll();
}
?>
<h1 style="margin-top: 30px; text-align: center; font-weight: bold;">게시판</h1>
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
			<td><?=$row['id'];?></td>
			<td><?=$row['title'];?></td>
			<td><?=$row['created_at'];?></td>
			<td><?=$row['user_id'];?></td>
			<td><?=$row['hit'];?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php
require_once("footer.php");