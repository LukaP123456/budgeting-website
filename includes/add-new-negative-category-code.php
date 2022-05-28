<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['category_type2']) && isset($_POST['category_name2'])){

    $category_type = $_POST['category_type2'];
    $category_name = $_POST['category_name2'];
    $house_id = $_POST['house_hold_id2'];

    $date_time = date('Y-m-d H:i:s');

    $error_empty = false;

    if (empty($category_name)) {
        echo "<p class='alert alert-danger' role='alert'>Please fill in the field.</p>";
        $error_empty = true;
    }else{
        $insert_category = new Insert_get();

        if ($insert_category->insert_category($category_name, $category_type, $house_id, $date_time)){
            die("success");
        }else{
            die("false");
        }
    }
}else{
    echo "<p class='alert alert-danger' role='alert'>There was an error</p>";
}?>

<script type="text/javascript">

    $(`#neg_category,#neg_amount`).removeClass("border border-danger");

    let error_empty = "<?php echo $error_empty;?>"

    if (error_empty === true) {
        $("#category_name").addClass("border border-danger")
    }

    if (error_empty === false && neg_category_error === false && neg_date_error === false){
        $("#goal_name,#amount,#neg_date").val("");
    }

</script>
