<?php
$host = getenv('DB_HOST') ?: 'mysql';
$user = getenv('DB_USER') ?: 'demo';
$password = getenv('DB_PASSWORD') ?: '';
$database = getenv('DB_NAME') ?: 'demo';

$mysqli = @new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    http_response_code(500);
    echo "Verbindung zur Datenbank fehlgeschlagen: " . htmlspecialchars($mysqli->connect_error);
    exit;
}

$result = $mysqli->query('SELECT id, first_name, last_name, role, hired_at FROM employees ORDER BY id');
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>M324 Demo Mitarbeiter</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 2rem; background: #f5f5f5; }
    h1 { margin-bottom: 0.5rem; }
    table { border-collapse: collapse; background: #fff; min-width: 480px; box-shadow: 0 2px 6px rgba(0,0,0,0.12); }
    th, td { padding: 0.5rem 0.75rem; border-bottom: 1px solid #ddd; text-align: left; }
    th { background: #0d6efd; color: #fff; }
    tr:last-child td { border-bottom: none; }
    .status { margin: 0 0 1rem; color: #444; }
  </style>
</head>
<body>
  <h1>Mitarbeiter aus MySQL</h1>
  <p class="status">DB Host: <?php echo htmlspecialchars($host); ?>, DB: <?php echo htmlspecialchars($database); ?></p>
  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Vorname</th>
          <th>Nachname</th>
          <th>Rolle</th>
          <th>Erstellt</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['id']); ?></td>
          <td><?php echo htmlspecialchars($row['first_name']); ?></td>
          <td><?php echo htmlspecialchars($row['last_name']); ?></td>
          <td><?php echo htmlspecialchars($row['role']); ?></td>
          <td><?php echo htmlspecialchars($row['hired_at']); ?></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Keine Daten gefunden.</p>
  <?php endif; ?>
</body>
</html>
