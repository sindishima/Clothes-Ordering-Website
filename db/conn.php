<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $host = '127.0.0.1';
    $db = 'finalproject';
    $user = 'root';
    $password = '';
    $charset = 'utf8mb4';   //unicode encoding
    $dsn = "mysql:host=$host; dbname=$db; charset=$charset";   //data source name - connect to database(mySQL)

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   //set attribute for message reporting
    } catch (PDOException $ex) {
        echo '<div class="alert alert-danger" role="alert">
                Failed to connect. '. $ex -> getMessage() .'</div>';
    }

    

    function select_all($table) {
        $sql = "select * from $table";
        global $pdo;
        return $pdo->query($sql);
    }
    
    
    function delete($table, $id) {
        try {
            $sql = "delete from $table where id=:id";
            global $pdo;
            $stmt = $pdo -> prepare($sql);   //prepares a statement for execution and returns a statement object
            $stmt -> bindParam(":id", $id);
            $stmt -> execute();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    function insert_record($table, $map) {
        try {
            global $pdo;
            $map_func = function($el) {
                return ":$el";
            };
            $keys = implode(", ", array_keys($map));
            $values = implode(", ", array_map($map_func, array_keys($map)));
            $sql = "insert into $table ($keys) values ($values);";
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute($map);
            return true;
        } catch (PDOException $ex) {
            echo $ex -> getMessage() . '<br>';
            return false;
        }
    }

    function update_record ($table, $data, $filters) {
        try {
            $map_func = function($el) {
                return "$el=:$el";
            };
            global $pdo;
            $placeholders = implode(", ", array_map($map_func, array_keys($data)));
            $filters_placeholders = implode(" and ", array_map($map_func, array_keys($filters)));  //join array el with a string
            $sql = "update $table set $placeholders where $filters_placeholders";
            $merged_data = array_merge($data, $filters);
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute($merged_data);
            return true;
        } catch (PDOException $ex) {
            echo $ex -> getMessage() . '<br>';
            return false;
        }
    }
    
    function select_by_properties($table ,$filters){
        try {
            $map_func = function($el) {
                return "$el=:$el";
            };
            global $pdo;
            $filters_placeholders = implode(" and ", array_map($map_func, array_keys($filters)));  //join array el with a string
            $sql = "select * from $table  where $filters_placeholders";
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute($filters);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex -> getMessage() . '<br>';
            return null;
        }
    }

    function res_from_query($query) {
        global $pdo;
        return $pdo->query($query);
    }
    
?>