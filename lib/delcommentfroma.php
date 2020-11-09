<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/config.inc.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/static/conn.php"); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . "/lib/profile.php"); ?>
<?php 
    $stmt = $conn->prepare("SELECT * FROM comments WHERE author = ? AND id = ?");
    $stmt->bind_param("si", $_SESSION['siteusername'], $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0) die('No coimment');
    while($row = $result->fetch_assoc()) {
        deleteComment($_GET['id'], $conn);
    }
    $stmt->close();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>