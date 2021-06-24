<?php
//board2.php
require_once("header.php");
?>
<h1 class="mt-5">게시판2</h1>
<div id="posts"></div>
<p class="text-center">
	<button class="btn btn-primary" onclick="getList()">더보기</button>
</p>
<script>
	var page = 1;
	function getList() {
		var send_data = {};
		send_data.page = page;
		send_data.action = "getposts";
		$.post("action.php", send_data, function(res){
			var json = $.parseJSON(res);
			addList(json);
			page++;
		});
	}
	getList();
	function addList(json) {
		for(var i=0; i<json.length; i++) {
			var row = json[i];
			var card = `<div class='card mb-3'>
										<div class='card-body'>
											<h5 class='card-title'>${row.title}</h5>
											<p class='card-text'>${row.content}</p>
										</div>
										<div class='card-footer'>${row.created_at}</div>
								</div>`;
			$("#posts").append(card);
		}
	}

	$(window).scroll(function(){
		var st = $(window).scrollTop(); //스크롤 상단 좌표
		var wh = $(window).height(); //창 높이
		var dh = $(document).height(); //문서 높이
		if( (st + wh) == dh ) getList();
	});

</script>
<?php
require_once("footer.php");