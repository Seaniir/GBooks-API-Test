<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="library.css" />
    <link rel="stylesheet" href="mystyle.css" />
    <title>Dashboard</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="616427647027-4qae6brl9pjqs9jbg4aftc5uf8qeobp5.apps.googleusercontent.com">

</head>
<body>
<a target="_blank"  href="https://www.amazon.fr/gp/product/236852536X/ref=as_li_tl?ie=UTF8&camp=1642&creative=6746&creativeASIN=236852536X&linkCode=as2&tag=seanir-21&linkId=e25d518d9f081940ae710492abf24ed8"><img border="0" src="//ws-eu.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=FR&ASIN=236852536X&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=seanir-21" ></a>
<a target="_blank"  href="https://www.amazon.fr/gp/product/2092574647/ref=as_li_tl?ie=UTF8&camp=1642&creative=6746&creativeASIN=2092574647&linkCode=as2&tag=seanir-21&linkId=8e42896b2f930c2def7febf4cf7b84e8"><img border="0" src="//ws-eu.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=FR&ASIN=2092574647&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=seanir-21" ></a>
<a target="_blank"  href="https://www.amazon.fr/gp/product/2372871536/ref=as_li_tl?ie=UTF8&camp=1642&creative=6746&creativeASIN=2372871536&linkCode=as2&tag=seanir-21&linkId=7658265726f2a3c4c3307dc3842ac5db"><img border="0" src="//ws-eu.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=FR&ASIN=9782092580219&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=seanir-21" ></a>
<?php
$mysqli = new mysqli("localhost", "root", "");
$db = mysqli_select_db($mysqli, "google_login");
$query = mysqli_query($mysqli, "select * from tbl_users");
?>

<?php
$i = 0;
$name = $_COOKIE["gfg"];
while ($row = mysqli_fetch_array($query))
{
    if ($row["fld_user_email"] == $name)
    {
?>
<header>
<script>
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
        window.location.href = "index.html";
      });
    }

    function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
  </script>
      <button onclick="signOut()">Sign out</button>
      <button onclick="window.location.href = 'dashboard.php';">Dashboard</button>

  <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="myscript.js"></script>
</header>
<div class="userContainer">
        <div class="detailsImg">
            <img src="touch-id.png" alt="">
            <img src="profile.png" alt="">
            <img src="email.png" alt="">
        </div>
        <div class="userDetails">
            <span><?php echo $row["fld_google_id"]; ?></span>
            <span><?php echo $row["fld_user_name"]; ?></span>
            <span><?php echo $row["fld_user_email"]; ?></span>
        </div>

        <img class = "userImg" src="<?php echo $row["fld_user_img"]; ?>" alt=""></img>

</div>

<?php
        $i++;
    }
}
?>
<?php
$name = $_COOKIE["toz"];
$tbl = "tbl";
$tbl .= $name;
$mysqli = new mysqli("localhost", "root", "");
$db = mysqli_select_db($mysqli, "google_login");
$query = mysqli_query($mysqli, "select * from ".$tbl."");
?>

<div class="flexatron">
<?php
$i = 0;
while ($row = mysqli_fetch_array($query))
{
?>
        <?php 
        $fleximax = "//ws-eu.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=FR&ASIN=";
        $fleximax .= $row["isbn"]; 
        $fleximax .= "&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=seanir-21";
        ?>
        <div class="booksCards">
            <span><?php echo $row["titles"]; ?></span>
            <span><?php echo $row["authors"]; ?></span>
            <span><img src=<?php echo $fleximax?> alt=""></span>
        </div>

<?php
        $i++;
    }
    
?>

</div>

</body>
</html>
