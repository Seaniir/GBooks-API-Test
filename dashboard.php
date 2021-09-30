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
      <button onclick="window.location.href = 'library.php';">Library</button>

  <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
<div id="search" class="#f5f5f5 grey lighten-4 z-depth-5">
        <div class="input-field">
          <input type="search" id="books">
        </div>
        <button id='test' class="btn red">Search Books</button>
    </div>
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

</body>
</html>
