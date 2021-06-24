//app.js
$(".btn-write, .btn-x").on("click",function(event){
	event.preventDefault();
	$("#title").val("");
	$("#content").val("");
	$("#form-box").slideToggle();
});

$(".board-del").on("click", function(event){
	event.preventDefault();
	var id = $(this).attr("href");
	if( ! id ) return;
	if( ! confirm("정말 지울까요?") ) return;
	var send_data = {};
	send_data.id = id;
	send_data.action = "delpost";
	$.post("action.php", send_data, function(result){
		var json = $.parseJSON(result);
		alert(json.msg);
		if( json.success ) {
			location.href = "/board.php";
		}
	});
});

$(".page-link").on("click", function(event){
	event.preventDefault();
	var pg = $(this).attr("href");
	location.href = "board.php?page=" + pg;
});