<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="mystyle.css" />
    <title>Dashboard</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="616427647027-4qae6brl9pjqs9jbg4aftc5uf8qeobp5.apps.googleusercontent.com">

</head>
<body>
<?php
$mysqli = new mysqli("localhost", "root", "");
$db = mysqli_select_db($mysqli, "google_login");
$query = mysqli_query($mysqli, "select * from tbl_titles");
?>

<?php
$i = 0;
$name = $_COOKIE["gfg"];
while ($row = mysqli_fetch_array($query))
{
?>

        <div class="userDetails">
            <span><?php echo $row["title"]; ?></span>
        </div>

<?php
        $i++;
    }
?>

</body>
</html>
