<?php
	
	$connectB = mysqli_connect("localhost", "root", "", "doingsdone");
	$sql = "SELECT name from proect";
	$result = mysqli_query($connectB, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$sql = "SELECT * from task";
	$result = mysqli_query($connectB, $sql);
	$rows1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

    require_once('helpers.php');
    $page_content = include_template('main.php',['proectL' => $rows, 'taskL' => $rows1, 'tableTask' => $tableTask, 'category' => $category, 'show_complete_tasks' => $show_complete_tasks]);
    $layout_content = include_template('layout.php',['content'=> $page_content, 'title' => 'Начальная страница']);

    print($layout_content);
?>