<?php
require_once "dbh.classes.php";

class Insert_get extends Dbh
{


    function insert_goal($user_id, $amount, $goal)
    {

        $insert_stmt = $this->connect()->prepare("INSERT INTO goals(goal_name, goal_price, user_id) VALUES (?,?,?)");

        if ($insert_stmt->execute(array($goal, $amount, $user_id))) {

            $get_stmt = $this->connect()->prepare("SELECT * FROM goals WHERE goal_name=? AND goal_price=? AND user_id=? ");

            if ($get_stmt->execute(array($goal, $amount, $user_id))) {

                $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                    $goal = $selector[$i]['goal_name'];
                    $amount = $selector[$i]['goal_price'];
                    $user_id = $selector[$i]['user_id'];
                    $goal_achieved = $selector[$i]['goal_achieved'];

                }

                setcookie("goal", $goal, time() + (10 * 365 * 24 * 60 * 60), "/", "");
                setcookie("amount", $amount, time() + (10 * 365 * 24 * 60 * 60), "/", "");
                setcookie("user_id", $user_id, time() + (10 * 365 * 24 * 60 * 60), "/", "");
                setcookie("goal_achieved", $goal_achieved, time() + (10 * 365 * 24 * 60 * 60), "/", "");

                return true;
            }
            return false;

        }
    }

    function get_category1()
    {

        $get_stmt = $this->connect()->prepare("SELECT category_id,category_name FROM cateogries WHERE category_type=0;");

        $get_stmt->execute();

        while ($selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC)) {
            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                echo '<option value="' . $selector[$i]['category_id'] . '">' . $selector[$i]['category_name'] . '</option>';
            }
        }

    }

    function get_category2()
    {

        $get_stmt = $this->connect()->prepare("SELECT category_id,category_name FROM cateogries WHERE category_type=1;");

        $get_stmt->execute();

        while ($selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC)) {
            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                echo '<option value="' . $selector[$i]['category_id'] . '">' . $selector[$i]['category_name'] . '</option>';
            }
        }

    }

    function get_house_id($user_id)
    {

        $select_stmt = $this->connect()->prepare("SELECT * FROM household_accounts  WHERE user_id=? LIMIT 1;");

        if ($select_stmt->execute(array($user_id))) {
            if ($select_stmt->rowCount() > 0) {
                while ($selector = $select_stmt->fetchAll(PDO::FETCH_ASSOC)) {
                    for ($i = 0; $i < $select_stmt->rowCount(); $i++) {
                        $house_id = $selector[$i]["house_hold_id"];
                    }
                }


            }
        }
        return $house_id;
    }

    function insert_category($category_name, $category_type, $house_id, $category_date_added)
    {

        $insert_category = $this->connect()->prepare("INSERT INTO cateogries( `category_name`, `category_type`, `household_id`, `category_date_added`) VALUES (?,?,?,?)");

        if ($insert_category->execute(array($category_name, $category_type, $house_id, $category_date_added))) {
            if ($insert_category->rowCount() > 0) {
               return true;
            }
        }
        return false;

    }


}
