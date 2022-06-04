<?php
require_once "../classes/insert-get-class.php";


if (isset($_POST['category'])){

    $category = $_POST['category'];

    $delete = new Insert_get();
    $delete->delete_category($category);

}else{
    die("<p class='alert alert-danger' role='alert'>Unreachable</p>");
}