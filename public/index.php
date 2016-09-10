<?php
  session_start();
  require_once('../includes/helpers.php');
  $dom = simplexml_load_file("../xml/bbt.xml");
  if(!isset($_SESSION['cart']))
    $_SESSION['cart']= array();
    $count=0;
  $active = 1;
 //determine which page to render
if(isset($_POST["order"])){
  $temp = explode(",", $_POST['order']);
  $active = $temp[3];
  $_SESSION['cart'][] = $_POST["order"];
  $count= count($_SESSION['cart']);
  $page = 'menu';
}
elseif (isset($_POST['name']) && isset($_POST['phone_number'])) {
  $page = 'confirmation';
  $name = $_POST['name'];
  $phone = $_POST['phone_number'];
}
elseif (isset($_GET['page']))
  $page = $_GET['page'];
else
  $page = 'menu';

// show page
switch ($page) {
  case 'menu':
    render('templates/header', array('title' => 'MENU', 'cart'=>"$count"));
    require('../includes/ajax.php');
    render('templates/navbar', array('title' => 'MENU', 'cart'=>"$count"));
    // print_r($_SESSION['cart']);
    require('../views/menu.php');
    render('templates/footer');
    break;

  case 'check_out':
    render('templates/header', array('title' => 'MENU', 'cart'=>"$count"));
    require('../includes/ajax.php');
    render('templates/navbar', array('title' => 'MENU', 'cart'=>"$count"));
    render('templates/check_out');
    render('templates/footer');
    break;

  case 'confirmation':
    render('templates/header', array('title' => 'MENU', 'cart'=>"$count"));
    render('includes/ajax');
    render('templates/navbar', array('title' => 'MENU', 'cart'=>"$count"));
    render('templates/confirmation', array('name' => "$name", 'phone' => "$phone"));
    render('templates/footer');
    break;

  case 'store':
    render('templates/header', array('title' => 'List of Orders'));
    require('../includes/ajax.php');
    render('store/store_side');
    render('templates/footer');
    break;
}
?>
