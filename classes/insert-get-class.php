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


    function get_previous_goals($house_id)
    {
        $get_stmt = $this->connect()->prepare("SELECT accounts.users_email,goals.goal_name,goals.added_date,goals.goal_price FROM accounts INNER JOIN goals on accounts.users_id = goals.user_id WHERE user_id IN (SELECT user_id from household_accounts where household_accounts.house_hold_id = ?) ORDER BY  added_date desc LIMIT 100 OFFSET 1");

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

    function search_costs($house_id, $search_text)
    {

        $get_stmt = $this->connect()->prepare("SELECT amount,
date_added,
category_name,
users_email,
cost_description
FROM cash_flow cf
INNER JOIN cateogries cat 
ON cf.category_id = cat.category_id
INNER JOIN accounts a 
ON cf.users_id = a.users_id WHERE cf.users_id IN (SELECT user_id FROM household_accounts WHERE household_accounts.house_hold_id = :house_id) AND cf.positive_negative = 0 
AND category_name LIKE  CONCAT('%',:search_text,'%')

ORDER By cf.date_added DESC LIMIT 200");

        $get_stmt->bindParam(':search_text', $search_text, PDO::PARAM_STR);
        $get_stmt->bindParam(':house_id', $house_id, PDO::PARAM_STR);

        if ($get_stmt->execute()) {


            while ($selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC)) {
                for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                    echo "Amount: $";
                    echo $selector[$i]['amount'] . "<br>";
                    echo " Category: ";
                    echo $selector[$i]['category_name'] . "<br>";
                    echo " Date added: ";
                    echo $selector[$i]['date_added'] . "<br>";
                    echo " Added by: ";
                    echo $selector[$i]['users_email'] . "<br>";
                    echo " Cost description: ";
                    echo $selector[$i]['cost_description'] . "<br>";
                    echo "<hr>";

                }
            }

        }
    }


    function get_all_costs($house_id)
    {
        $get_stmt = $this->connect()->prepare("
SELECT amount,
date_added,
category_name,
users_email,
cost_description
FROM cash_flow cf
INNER JOIN cateogries cat 
ON cf.category_id = cat.category_id
INNER JOIN accounts a 
ON cf.users_id = a.users_id WHERE cf.users_id IN (SELECT user_id FROM household_accounts WHERE household_accounts.house_hold_id = ?) AND cf.positive_negative = 0 ORDER By cf.date_added DESC LIMIT 200
");

        if ($get_stmt->execute(array($house_id))) {

            $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                echo "Amount: $";
                echo $selector[$i]['amount'] . "<br>";
                echo " Category: ";
                echo $selector[$i]['category_name'] . "<br>";
                echo " Date added: ";
                echo $selector[$i]['date_added'] . "<br>";
                echo " Added by: ";
                echo $selector[$i]['users_email'] . "<br>";
                echo " Cost description: ";
                echo $selector[$i]['cost_description'] . "<br>";
                echo "<hr>";

            }
        }


    }

    function get_all_additions($house_id)
    {

        $get_stmt = $this->connect()->prepare("
SELECT amount,
date_added,
category_name,
users_email
FROM cash_flow cf
INNER JOIN cateogries cat 
ON cf.category_id = cat.category_id
INNER JOIN accounts a 
ON cf.users_id = a.users_id WHERE cf.users_id IN (SELECT user_id FROM household_accounts WHERE household_accounts.house_hold_id = ?) AND cf.positive_negative = 1 ORDER By cf.date_added DESC LIMIT 200
");

        if ($get_stmt->execute(array($house_id))) {

            $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                echo "Amount: $";
                echo $selector[$i]['amount'] . "<br>";
                echo " Category: ";
                echo $selector[$i]['category_name'] . "<br>";
                echo " Date added: ";
                echo $selector[$i]['date_added'] . "<br>";
                echo " Added by: ";
                echo $selector[$i]['users_email'] . "<br>";
                echo "<hr>";

            }
        }

    }


    function get_3_categories($house_id)
    {

        $get_stmt = $this->connect()->prepare("
SELECT amount,
date_added,
category_name,
users_email
FROM cash_flow cf
INNER JOIN cateogries cat 
ON cf.category_id = cat.category_id
INNER JOIN accounts a 
ON cf.users_id = a.users_id WHERE cf.users_id IN (SELECT user_id FROM household_accounts WHERE household_accounts.house_hold_id = ?) AND cf.positive_negative = 0 GROUP BY amount DESC LIMIT 3");

        if ($get_stmt->execute(array($house_id))) {

            $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {

                echo $selector[$i]['category_name'] . "<br>";
                echo "<br>";
            }

        } else {
            die("Error");
        }
    }


    function get_category0($group_id)
    {

        $get_stmt = $this->connect()->prepare("SELECT category_id,category_name,household_id FROM cateogries WHERE category_type=0 AND household_id=? OR household_id IS NULL AND NOT category_name = 'Salary' AND NOT category_name = 'Pension'  AND NOT category_name = 'Gift'  AND NOT category_name = 'Odd jobs' ");


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

        $get_stmt = $this->connect()->prepare("SELECT category_id,category_name,household_id FROM cateogries WHERE category_type=1 AND household_id=? OR household_id IS NULL AND NOT category_name = 'Eating out' AND NOT category_name = 'Shopping'  AND NOT category_name = 'Transportation'  AND NOT category_name = 'Entertainment'  AND NOT category_name = 'Family' AND NOT category_name = 'Health/Sport' AND NOT category_name = 'Pets' AND NOT category_name = 'Travels'");

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
            if ($category_type == 0 or $category_type == 1) {

                $insert_category = $this->connect()->prepare("INSERT INTO cateogries( `category_name`, `category_type`, `household_id`, `category_date_added`) VALUES (?,?,?,?)");

                if ($insert_category->execute(array($category_name, $category_type, $house_id, $category_date_added))) {
                    if ($insert_category->rowCount() > 0) {
                        return true;
                    }
                }

            } else {
                die("<p class='alert alert-danger' role='alert'>Category type is invalid</p>");
            }
        } else {
            die("<p class='alert alert-danger' role='alert'>Insert failed</p>");
        }
    }

    function insert_neg_money($neg_date, $neg_category, $amount, $user_id, $cost_description)
    {
        //Server side error handlers
        if (empty($neg_date) || empty($neg_category) || empty($amount) || empty($user_id) || empty($cost_description)) {
            die();
        }

        if (!is_numeric($amount)) {
            die();
        }

        $insert_neg_stmt = $this->connect()->prepare("INSERT INTO `cash_flow`( `amount`, `users_id`, `category_id`, `positive_negative`, `date_added`,cost_description) VALUES (?,?,?,0,?,?);");

        if ($insert_neg_stmt->execute(array($amount, $user_id, $neg_category, $neg_date, $cost_description))) {
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

    function get_expense_month($house_id)
    {


        $get_stmt = $this->connect()->prepare("
SELECT 
SUM(amount)
FROM cash_flow 
WHERE MONTH(date_added) = MONTH(CURRENT_DATE()) 
AND YEAR(date_added) = YEAR(CURRENT_DATE())
AND positive_negative = 0 AND users_id IN(SELECT user_id FROM household_accounts WHERE house_hold_id = ?)");

        if ($get_stmt->execute(array($house_id))) {

            $selector = $get_stmt->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < $get_stmt->rowCount(); $i++) {
                return $selector[$i]['SUM(amount)'];
            }
        }
    }

    //TODO:Napraviti da radi mozda
    function set_goal_achieved($house_id)
    {

        $set_stmt = $this->connect()->prepare("
SELECT 
SUM(amount)
FROM cash_flow 
WHERE MONTH(date_added) = MONTH(CURRENT_DATE()) 
AND YEAR(date_added) = YEAR(CURRENT_DATE())
AND positive_negative = 0 AND users_id IN(SELECT users_id FROM household_accounts WHERE house_hold_id = ?)");

        if ($set_stmt->execute()) {
            echo "true";
        } else {
            echo "false";
        }


    }

    function delete_category($category_id)
    {
        $delete_stmt = $this->connect()->prepare("DELETE FROM cateogries WHERE category_id=?;");

        try {
            if ($delete_stmt->execute(array($category_id))) {
                die("<div class='alert alert-success' role='alert'>Deleted the category</div>");
            } else {
                die("<div class='alert alert-danger' role='alert'>Failed to delete category <b>Warning!</b> Cannot delete category which has been used</div>");
            }
        } catch (PDOException $e) {
            die("<div class='alert alert-danger' role='alert'>Failed to delete category <b>Warning!</b> Cannot delete category which has been used</div>");
        }
    }


}
