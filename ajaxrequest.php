<?php


//#########################################################
//PDO connection
try {
    $pdo = new PDO("sqlite:database.db");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: No se pudo conectar. " . $e->getMessage());
}

// Verifica si se recibió un término de búsqueda
if (isset($_REQUEST["term"])) {
    $sql = "SELECT DISTINCT country FROM cities WHERE country LIKE ? LIMIT 10";

    try {
        $stmt = $pdo->prepare($sql);
        $param_term = '%' . $_REQUEST["term"] . '%';

        if ($stmt->execute([$param_term])) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($rows) > 0) {
                foreach ($rows as $row) {
                    echo "<option value='" . htmlspecialchars($row["country"]) . "'>";
                }
            } else {
                echo "<p>No matches found</p>";
            }
        }
    } catch (PDOException $e) {
        echo "ERROR al ejecutar la consulta: " . $e->getMessage();
    }
}



//#########################################################
//MYSQLI connection

/*
$mysqli = new mysqli("localhost", "root", "toor", "ajax");
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT distinct country FROM cities WHERE country LIKE ? LIMIT 10";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_term);
        
        // Set parameters
        $param_term = '%' . $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            // Check number of rows in the result set
            if($result->num_rows > 0){
                // Fetch result rows as an associative array
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    echo "<option value='" . $row["country"] .  "'>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    $stmt->close();
}
 
// Close connection
$mysqli->close();
*/
