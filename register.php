<?php
header('Content-Type: application/json');
$servername = "localhost"; // Замените на ваши данные
$username = "root"; // Замените на ваши данные
$password = ""; // Замените на ваши данные
$dbname = "your_database"; // Замените на название вашей базы данных
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die(json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных']));
}
$data = json_decode(file_get_contents("php://input"), true);
$username = $conn->real_escape_string($data['username']);
$email = $conn->real_escape_string($data['email']);
$password = password_hash($data['password'], PASSWORD_BCRYPT); // Хеширование пароля
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
echo json_encode(['success' => true]);
} else {
echo json_encode(['success' => false, 'message' => 'Ошибка: ' . $conn->error]);
}
$conn->close();
?>