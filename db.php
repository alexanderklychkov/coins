<?php

    function dbConnect() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db_name = 'coins_bd';

        $link = new mysqli($host, $user, $pass, $db_name);
        return $link;
    }

    function closeConnection($link) {
        $link->close();
    }

    function checkPlayer($login) {
        $db_connection = dbConnect();
        $query = $db_connection->query("SELECT `id` FROM `players` WHERE `name` = '{$login}'");
        closeConnection($db_connection);
        return $query;
    }

    function addPlayer($login) {
        $db_connection = dbConnect();
        $query2 = $db_connection->query("INSERT INTO `players` (`name`) VALUES ('{$login}')");
        closeConnection($db_connection);
        return $query2;
    }

    function addScore($number, $login) {
        $db_connection = dbConnect();
        $query3 = $db_connection->query("UPDATE `players` SET `score` = {$number} WHERE `name` = '{$login}'");
        closeConnection($db_connection);
        return $query3;
    }
    
    function getPlayersList() {
        $db_connection = dbConnect();
        $num = $db_connection->query("SET @n:=0");
        $result = $db_connection->query("SELECT @n:=@n+1 as `num`, `id`, `name`, `score` from `players` ORDER BY `score` DESC");
        // $query4 = $db_connection->query("SELECT `num`, `id`, `name`, `score` FROM `players` WHERE `name` = '{$login}'");
        // $result = $db_connection->query("SET @n := 0;
        // SELECT @n:=@n+1 as `num`, `id`, `number`, `name`, `score` from `players` ORDER BY `score` DESC;");
        // $result = $db_connection->query("SELECT * FROM `players` ORDER BY `score` DESC");
        $listPlayers = array();
        // $player = array();
        while ($row = $result->fetch_row()) {
            $listPlayers[] = $row;
        }
        closeConnection($db_connection);
        return $listPlayers;
    }

    // INSERT INTO `players` (`score`) VALUES ('{$number}') WHERE name ('{$login}');