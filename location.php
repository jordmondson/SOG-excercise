<?php
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$location = urldecode($queries['location']);

$db = new PDO('sqlite:FPA_FOD_20170508.sqlite');

$sql = "SELECT FPA_ID, FIRE_NAME, DISCOVERY_DATE FROM Fires WHERE NWCG_REPORTING_UNIT_NAME = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$location]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forest Fires</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="limited-width">
        <ul>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <li><?php echo sprintf('%s: %s at %s', $row['FPA_ID'], $row['FIRE_NAME'], $row['DISCOVERY_DATE']) ?> </li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>