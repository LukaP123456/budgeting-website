<?php
require_once "dbh.classes.php";

class Insert_get extends Dbh
{

    function get_group_name($user_id)
    {

        $get_stmt = $this->connect()->prepare("SELECT household_name from household WHERE household_id in(SELECT house_hold_id from household_accounts where user_id = ?);");

        if ($get_stmt->execute(array($user_id))) {

            $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['group_name'] = $selector[0]['household_name'];

//            setcookie("group_name", $selector[0]['household_name'], time() + (10 * 365 * 24 * 60 * 60), "/", "");
            //TODO:$_COOKIE['group_name'] sam izbrisao jer zapravo ne radi kako treba, kod korisnika koji su u kuci "sama kuca" ispisuje naziv suprotne i obrnuto
        }
    }


    /**
     * @param $user_id
     * @param $amount
     * @param $goal
     * @return bool|void
     */
    function insert_goal($user_id, $amount, $goal)
    {
        if (empty($amount) || empty($goal) || empty($user_id)) {
            return false;
            die();
        }

        if (!ctype_alpha($goal)) {
            return false;
            die();
        }

        //select date max

        $insert_stmt = $this->connect()->prepare("INSERT INTO goals(goal_name, goal_price, user_id,added_date) VALUES (?,?,?,now())");

        if ($insert_stmt->execute(array($goal, $amount, $user_id))) {

            $get_stmt = $this->connect()->prepare("SELECT * FROM goals WHERE goal_name=? AND goal_price=? AND user_id=? AND added_date = (SELECT MAX(added_date) FROM goals) ");

            if ($get_stmt->execute(array($goal, $amount, $user_id))) {

                $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                    $goal = $selector[$i]['goal_name'];
                    $amount = $selector[$i]['goal_price'];
                    $goal_achieved = $selector[$i]['goal_achieved'];

                }

                setcookie("goal", $goal, time() + (10 * 365 * 24 * 60 * 60), "/", "");
                setcookie("amount", $amount, time() + (10 * 365 * 24 * 60 * 60), "/", "");
                setcookie("goal_achieved", $goal_achieved, time() + (10 * 365 * 24 * 60 * 60), "/", "");

                return true;
            }
            return false;

        }
    }

    //TODO:Daje samo gooals koje je jedan user uneo zbog LIMIT 1 a bez njega ne radi
    function get_previous_goals($house_id)
    {
        $get_stmt = $this->connect()->prepare("SELECT accounts.users_email,goals.goal_name,goals.added_date,goals.goal_price FROM accounts INNER JOIN goals on accounts.users_id = goals.user_id WHERE user_id = (SELECT user_id from household_accounts where household_accounts.house_hold_id = ? LIMIT 1) ORDER BY  added_date desc LIMIT 100 OFFSET 1");

        if ($get_stmt->execute(array($house_id))) {

            $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                echo "Goal: ";
                echo $selector[$i]['goal_name'] . "<br>";
                echo " Amount: ";
                echo "$" . $selector[$i]['goal_price'] . "<br>";
                echo " Date added: ";
                echo $selector[$i]['added_date'] . "<br>";
                echo " Added by: ";
                echo $selector[$i]['users_email'];
                echo "<br><hr>";
            }

        }

    }

    //TODO:Popraviti da kveriji pokazuju sve vrednosti ne samo one koje je jedan user stavio
    function get_all_costs($house_id)
    {
        $get_stmt = $this->connect()->prepare("SELECT * FROM cash_flow WHERE users_id = (SELECT user_id from household_accounts where house_hold_id = ? LIMIT 1) AND positive_negative = 0 ORDER BY  date_added desc;");

        if ($get_stmt->execute(array($house_id))) {

            $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                echo "Amount: $";
                echo $selector[$i]['amount'] . "<br>";
                echo " Category: ";
                echo $selector[$i]['category_id'] . "<br>";
                echo " Date added: ";
                echo $selector[$i]['date_added'] . "<br>";
                echo " Added by: ";
                echo $selector[$i]['users_id'] . "<br>";
                echo "<br><hr>";

            }
        }


    }

    function get_all_additions($house_id)
    {

        $get_stmt = $this->connect()->prepare("SELECT * FROM cash_flow WHERE users_id = (SELECT user_id from household_accounts where house_hold_id = ? LIMIT 1) AND positive_negative = 1 ORDER BY  date_added desc;");

        if ($get_stmt->execute(array($house_id))) {

            $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                echo "Amount: $";
                echo $selector[$i]['amount'] . "<br>";
                echo " Category: ";
                echo $selector[$i]['category_id'] . "<br>";
                echo " Date added: ";
                echo $selector[$i]['date_added'] . "<br>";
                echo " Added by: ";
                echo $selector[$i]['users_id'] . "<br>";
                echo "<br><hr>";

            }
        }

    }

    function get_category0($group_id)
    {

        $get_stmt = $this->connect()->prepare("SELECT category_id,category_name FROM cateogries WHERE category_type=0 AND  household_id=? OR household_id IS NULL");


        if ($get_stmt->execute(array($group_id))) {
            while ($selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC)) {
                for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                    echo '<option value="' . $selector[$i]['category_id'] . '">' . $selector[$i]['category_name'] . '</option>';
                }
            }
        }
    }

    function get_category1($group_id)
    {

        $get_stmt = $this->connect()->prepare("SELECT category_id,category_name FROM cateogries WHERE category_type=1 AND  household_id=? OR household_id IS NULL");

        if ($get_stmt->execute(array($group_id))) {
            while ($selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC)) {
                for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                    echo '<option value="' . $selector[$i]['category_id'] . '">' . $selector[$i]['category_name'] . '</option>';
                }
            }
        }


    }

    function get_house_id($user_id)
    {
        $house_id = 0;

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
        if (empty($category_name) || empty($house_id) || empty($category_date_added)) {
            die("<p class='alert alert-danger' role='alert'>One of the inserted values is empty</p>");
        }

        if (isset($category_type)) {
            if ($category_type == 0 OR $category_type == 1) {

                $insert_category = $this->connect()->prepare("INSERT INTO cateogries( `category_name`, `category_type`, `household_id`, `category_date_added`) VALUES (?,?,?,?)");

                if ($insert_category->execute(array($category_name, $category_type, $house_id, $category_date_added))) {
                    if ($insert_category->rowCount() > 0) {
                        return true;
                    }
                }

            } else{
                die("<p class='alert alert-danger' role='alert'>Category type is invalid</p>");
            }
        }else{
            die("<p class='alert alert-danger' role='alert'>Insert failed</p>");
        }
    }

    function insert_neg_money($neg_date, $neg_category, $amount, $user_id)
    {
        //Server side error handlers
        if (empty($neg_date) || empty($neg_category) || empty($amount) || empty($user_id)) {
            die();
        }

        if (!is_numeric($amount)) {
            die();
        }

        $insert_neg_stmt = $this->connect()->prepare("INSERT INTO `cash_flow`( `amount`, `users_id`, `category_id`, `positive_negative`, `date_added`) VALUES (?,?,?,0,?);");

        if ($insert_neg_stmt->execute(array($amount, $user_id, $neg_category, $neg_date))) {
            if ($insert_neg_stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    function insert_pos_money($pos_date, $pos_category, $pos_amount, $user_id)
    {

        if (empty($pos_amount) || empty($pos_category) || empty($user_id) || empty($pos_date)) {
            die();
        }

        if (!is_numeric($pos_amount)) {
            die();
        }

        $insert_neg_stmt = $this->connect()->prepare("INSERT INTO `cash_flow`( `amount`, `users_id`, `category_id`, `positive_negative`, `date_added`) VALUES (?,?,?,1,?);");

        if ($insert_neg_stmt->execute(array($pos_amount, $user_id, $pos_category, $pos_date))) {
            if ($insert_neg_stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }


    }

    function get_budget($group_id): string
    {
        $return_value = 0;

        $get_stmt = $this->connect()->prepare("SELECT SUM(amount) FROM cash_flow WHERE positive_negative=1 AND users_id IN(SELECT user_id FROM household_accounts WHERE house_hold_id = ?);");

        if ($get_stmt->execute(array($group_id))) {
            if ($get_stmt->rowCount() > 0) {
                while ($selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC)) {
                    for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                        $budget = $selector[$i]["SUM(amount)"];
                        $return_value = number_format((float)$budget, 2, '.', '');
                    }
                }
            }
        }

        return $return_value;

    }

    function get_expenses($group_id): string
    {
        $return_value = 0;

        $get_stmt = $this->connect()->prepare("SELECT SUM(amount) FROM cash_flow WHERE positive_negative=0 AND users_id IN(SELECT user_id FROM household_accounts WHERE house_hold_id = ?);");

        if ($get_stmt->execute(array($group_id))) {
            if ($get_stmt->rowCount() > 0) {
                while ($selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC)) {
                    for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                        $expenses = $selector[$i]["SUM(amount)"];
                        $return_value = number_format((float)$expenses, 2, '.', '');
                    }
                }
            }
        }

        return $return_value;

    }

    function get_expense_week($house_id){
        $return_value = 0;

        $get_stmt =$this->connect()->prepare("SELECT * FROM cash_flow WHERE users_id IN (SELECT user_id FROM household_accounts where house_hold_id = ?) AND date_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY AND positive_negative = 0;") ;

        if ($get_stmt->execute(array($house_id))){

            while ($selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC)){
                for ($i = 0; $i < $get_stmt->rowCount(); $i++){
                    $return_value = $selector['amount'];
                }
            }
        }

        return $return_value;
    }

}
