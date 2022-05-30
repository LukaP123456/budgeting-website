<?php

class Dbh
{

    /**
     * @return PDO|void
     */
    protected function connect()
    {
        try {
            $username = "root";
            $password = "root";
            $dbh = new PDO('mysql:host=localhost;dbname=cost', $username, $password);
            return $dbh;

        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }


}
