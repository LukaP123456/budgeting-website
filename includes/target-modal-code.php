<?php
require_once "../classes/insert-get-class.php";

if (isset($_POST['goal']) && isset($_POST['amount']) && isset($_COOKIE['users_id'])) {


    $goal = $_POST['goal'];
    $amount = $_POST['amount'];
    $users_id = $_COOKIE['users_id'];

    $error_empty = false;
    $goal_error = false;

    if (empty($goal) || empty($amount)) {
        echo "<p class='alert alert-danger' role='alert'>Please fill in all the fields</p>";
        $error_empty = true;
    } elseif (!ctype_alpha($goal)) {
        echo "<p class='alert alert-danger' role='alert'>Please only use letters when describing your goal</p>";
        $goal_error = true;
    } else {
        $insert_goal = new Insert_get();

        if ($insert_goal->insert_goal($users_id, $amount, $goal)) {
            die("success");
        } else {
            die("error");
        }

    }
} else {
    echo "<p class='alert alert-danger' role='alert'>There was an error</p>";
} ?>

<script type="text/javascript">

    $(`#goal_name,#amount`).removeClass("border border-danger");

    let error_empty = "<?php echo $error_empty;?>"
    let goal_error = "<?php echo $goal_error;?>"

    if (error_empty === true) {
        $("#goal_name").addClass("border border-danger")
    }

    if (goal_error === true){
        $("#amount").addClass("border border-danger")
    }

    if (error_empty === false && goal_error === false){
        $("#goal_name,#amount").val("");
    }

</script>


