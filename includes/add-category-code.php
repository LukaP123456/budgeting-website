<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['category_type']) && isset($_POST['category_name'])){

    $category_type = $_POST['category_type'];
    $category_name = $_POST['category_name'];
    $house_id = $_POST['house_hold_id'];

    $date_time = date('Y-m-d H:i:s');

    $error_empty = false;

    if (empty($category_name)) {
        echo "<p class='alert alert-danger' role='alert'>Please fill in the field.</p>";
        $error_empty = true;
    }else{
        $insert_category = new Insert_get();

        if ($insert_category->insert_category($category_name, $category_type, $house_id, $date_time)){
            die( "success");
        }else{
            die("false");
        }
    }

}else{
    echo "<p class='alert alert-danger' role='alert'>There was an error</p>";
}?>

<script type="text/javascript">

    $(`#category_name`).removeClass("border border-danger");

    let error_empty = "<?php echo $error_empty;?>"

    if (error_empty === true) {
        $("#category_name").addClass("border border-danger")
    }

    if (error_empty === false && neg_category_error === false && neg_date_error === false){
        $("#category_name").val("");
    }

</script>
