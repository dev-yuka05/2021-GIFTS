<?php
//config.php
try {
	$db = new PDO("mysql:host=localhost; dbname=myweb; charset=utf8;", "root", "");
} catch (PDOException $e) {
	die("sorry!!! " . $e->getMessage());
}


function pagination($total=0, $pageset=10, $blockset=10, $page=1) {
	$totalpage = ceil($total / $pageset); // 전체 페이지 수
	$totalblock = ceil($totalpage / $blockset); // 전체 페이지 븍록 수
	$block = ceil($page / $blockset); // 현재 페이지 블록
	$first_page = (($block - 1) * $blockset) + 1; // 현재 페이지 블록의 첫 번째 페이지
	$last_page = min($totalpage, $block * $blockset); // 현재 페이지 블록의 마지막 페이지
	$prev_page = $page - 1; // 이전 페이지
	$next_page = $page + 1; // 다음 페이지
	$prev_block = $block - 1; // 이전 페이지 블록
	$next_block = $block + 1; // 다음 페이지 블록
	$prev_block_page = $prev_block * $blockset; // 이전 페이지 블록의 마지막 페이지
	$next_block_page = $next_block * $blockset - ($blockset - 1); // 다음 페이지 블록의 첫 번째 페이지

	$paginationblock = "<div aria-label='...'><ul class='pagination justify-content-center'>";

	if( $page > 1 ) $paginationblock .= "<li class='page-item'><a class='page-link' href='1'>1</a></li>";
	else $paginationblock .=  "<li class='page-item disabled'><a class='page-link' href='1' tabindex='-1' aria-disabled='true'>1</a></li>";

	if( $prev_block > 0 ) $paginationblock .= "<li class='page-item'><a class='page-link' href='{$prev_block_page}'><i class='fas fa-chevron-left'></i></a></li>";
	else $paginationblock .= "<li class='page-item disabled'><a class='page-link' href='#!' tabindex='-1' aria-disabled='true'><i class='fas fa-chevron-left'></i></a></li>";

	for ( $i=$first_page; $i <= $last_page; $i++ ) {
		if($i != $page) $paginationblock .=  "<li class='page-item'><a class='page-link' href='{$i}'>{$i}</a></li>";
		else $paginationblock .=  "<li class='page-item active' aria-current='page'><a class='page-link' href='#!'>{$i}</a></li>";
	}

	if( $next_block <= $totalblock ) $paginationblock .= "<li class='page-item'><a class='page-link' href='{$next_block_page}'><i class='fas fa-chevron-right'></i></a></li>";
	else $paginationblock .=  "<li class='page-item disabled'><a class='page-link' href='#!' tabindex='-1' aria-disabled='true'><i class='fas fa-chevron-right'></i></a></li>";
	
	if( $page < $totalpage ) $paginationblock .= "<li class='page-item'><a class='page-link' href='{$totalpage}'>{$totalpage}</a></li>";
	else $paginationblock .=  "<li class='page-item disabled'><a class='page-link' href='#!' tabindex='-1' aria-disabled='true'>{$totalpage}</a></li>";

	$paginationblock .= "</ul></div>";

	return $paginationblock;
}