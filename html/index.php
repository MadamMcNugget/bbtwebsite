<?php
  session_start();
  require_once('../includes/helpers.php');
  $dom = simplexml_load_file("../xml/bbt.xml");
  if(!isset($_SESSION['cart']))
    $_SESSION['cart']= array();
    $count=0;
// determine which page to render
if(isset($_POST["order"])){
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
  $page = 'index';

// show page
switch ($page) {
  case 'index':
    render('templates/header', array('title' => 'CSCI S-75','truth' => 'Hazel is hungry','cart'=>"$count"));
    render('index');
    render('templates/footer');
    break;

  case 'menu':
    render('templates/header', array('title' => 'MENU', 'cart'=>"$count"));
    print_r($_SESSION['cart']);
    require('../views/menu.php');
    render('templates/footer');
    break;

  case 'check_out':
    render('templates/header', array('title' => 'MENU', 'cart'=>"$count"));
    render('templates/check_out');
    render('templates/footer');
    break;

  case 'confirmation':
    render('templates/header', array('title' => 'MENU', 'cart'=>"$count"));
    render('templates/confirmation', array('name' => "$name", 'phone' => "$phone"));
    render('templates/footer');

  case 'lecture':
    if (isset($_GET['n']))
    {
    render('templates/header', array('title' => 'Lecture '.$_GET['n']));
    render('lecture', array('n' => $_GET['n']));
    render('templates/footer');
    } 
    
    break;
  
  default:
    render('templates/header', array('title' => 'CSCI S-75'));
    echo "<b> The lecuture you are looking for does not exist </b><br>";
    render('index');
    render('templates/footer');
    break;
}
?>
