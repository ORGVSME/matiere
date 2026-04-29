<?php
// Générer les hashes bcrypt corrects
$passwords = [
    'admin123' => 'admin@sysinfo.mg',
    'user123' => 'user@sysinfo.mg',
    'test123' => 'test@example.com'
];

foreach ($passwords as $pwd => $email) {
    $hash = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 10]);
    echo "Email: $email | Mot de passe: $pwd | Hash: $hash\n";
}
?>
