<?php
// Test de connexion à la base de données

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'note';

try {
    // Connexion à MySQL
    $mysqli = new mysqli($hostname, $username, $password, $database);
    
    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die('Erreur de connexion : ' . $mysqli->connect_error);
    }
    
    echo "✓ Connexion établie avec succès à la base de données '$database'<br>";
    
    // Vérifier la table users
    $result = $mysqli->query("SHOW TABLES LIKE 'users'");
    
    if ($result->num_rows > 0) {
        echo "✓ Table 'users' existe<br>";
        
        // Afficher la structure
        $result = $mysqli->query("DESCRIBE users");
        echo "<br><strong>Structure de la table 'users' :</strong><br>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Field'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Null'] . "</td>";
            echo "<td>" . $row['Key'] . "</td>";
            echo "<td>" . $row['Default'] . "</td>";
            echo "<td>" . $row['Extra'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "✗ Table 'users' n'existe pas. Il faut exécuter le base.sql<br>";
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    echo "✗ Erreur : " . $e->getMessage();
}
?>
