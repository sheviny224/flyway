<?php
require_once "../user/User.php";
require_once "../booking/Booking.php";

$user = new User();
$booking = new Booking();

// Formulierverwerking
if (isset($_POST['save'])) {
    $role = 'coordinator';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password_hash = $_POST['password_hash'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (!empty($_POST['id'])) {
        $user->updateCoordinator($_POST['id'], $name, $email, $password_hash, $address, $phone);
    } else {
        $user->register($role, $name, $email, $password_hash, $address, $phone);
    }

    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


$coordinators = $user->getAllCoordinator();
$bookings = $booking->getAllBookings();

$editCoordinator = null;
if (isset($_GET['edit'])) {
    $editCoordinator = $user->getUserById($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
</head>
<body>
  <h1>Hallo admin</h1>
  <h2>Alle geregistreerde coördinatoren</h2>

  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>Naam</th>
        <th>Email</th>
        <th>Rol</th>
        <th>address</th>
        <th>phone</th>
        <th>Actie</th>`
        
      </tr>
    </thead>
    <tbody>
      <?php foreach ($coordinators as $coordinator): ?>
        <tr>
          <td><?= htmlspecialchars($coordinator['name']); ?></td>
          <td><?= htmlspecialchars($coordinator['email']); ?></td>
          <td><?= htmlspecialchars($coordinator['role']); ?></td>
          <td><?= htmlspecialchars($coordinator['address']); ?></td>
          <td><?= htmlspecialchars($coordinator['phone']); ?></td>
          <td>
            <a href="?edit=<?= $coordinator['user_id'] ?>">Bewerk</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h1>Alle boekingen</h1>
   <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>schedule_id</th>
        <th>name</th>
        <th>email</th>
        <th>seat_type</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bookings as $booking): ?>
        <tr>
          <td><?= htmlspecialchars($booking['schedule_id']); ?></td>
          <td><?= htmlspecialchars($booking['name']); ?></td>
          <td><?= htmlspecialchars($booking['email']); ?></td>
          <td><?= htmlspecialchars($booking['seat_type']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h2><?= $editCoordinator ? 'Coördinator wijzigen' : 'Nieuwe coördinator toevoegen' ?></h2>
  <form method="POST">
    <input type="hidden" name="id" value="<?= $editCoordinator['user_id'] ?? '' ?>">

    <label>Naam:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($editCoordinator['name'] ?? '') ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($editCoordinator['email'] ?? '') ?>" required><br><br>

    <label>Wachtwoord:</label><br>
    <input type="password" name="password_hash"><br><br>

    <label>Adres:</label><br>
    <input type="text" name="address" value="<?= htmlspecialchars($editCoordinator['address'] ?? '') ?>"><br><br>

    <label>Telefoonnummer:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($editCoordinator['phone'] ?? '') ?>"><br><br>

    <button type="submit" name="save">Opslaan</button>
  </form>
</body>
</html>
