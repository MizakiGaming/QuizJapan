<?php
$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "DAO" . DIRECTORY_SEPARATOR . "Connection.php";
require_once "{$link}";

if (isset($the_quiz_connect)) {
    if (isset($_GET['term'])) {
        $array = array();
        $input = $_GET['term'];
        $input = strtolower($input);

        $stmt = $the_quiz_connect->prepare("SELECT themes FROM `card_package` WHERE LOWER(themes) LIKE '%" . $input . "%' LIMIT 30");
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            foreach (explode(",", $row['themes']) as $word) {
                $word = strtolower($word);
                if (strpos($word, $input) !== false && in_array($word, $array) === false) {
                    array_push($array, $word);
                }
            }
        }

        echo json_encode($array);
    }
    $the_quiz_connect->close();
}