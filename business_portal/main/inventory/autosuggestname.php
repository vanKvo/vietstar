<?php
include('../connect.php');

if (isset($_POST['queryString'])) {
    $queryString = $_POST['queryString'];
    if (strlen($queryString) > 0) {
        $query = "SELECT cust_name FROM customer WHERE cust_name LIKE :queryString LIMIT 10";
        $stmt = $db->prepare($query);
        $searchString = $queryString . '%';
        $stmt->bindParam(':queryString', $searchString);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($results) > 0) {
            echo '<ul>';
            foreach ($results as $row) {
                echo '<li onClick="fill(\'' . addslashes($row['cust_name']) . '\');">' . htmlspecialchars($row['cust_name']) . '</li>';
            }
            echo '</ul>';
        }
    }
} else {
    echo 'There should be no direct access to this script!';
}
?>