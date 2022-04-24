<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>sign in</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
  <body>
    <form action="auth.php" method="POST">
      <input checked="" id="signin" name="action" type="radio" value="signin">
      <label for="signin">Sign in</label>

      <input id="signup" name="action" type="radio" value="signup">
      <label for="signup">Sign up</label>

      <input id="reset" name="action" type="radio" value="reset">

      <div id="wrapper">
        <div id="arrow"></div>
        <input id="email" name="login" placeholder="Nickname" type="text">
        <input id="pass" name="passwd" placeholder="Password" type="password">
        <input id="repass" name="token" placeholder="authentication token" type="password">
        <input id="repass" name="card" placeholder="credit card details" type="password">
      </div>
      <button type="submit">
        <span>
          Reset password
          <br>
          Sign in
          <br>
          Sign up
        </span>
      </button>
      <?php
        echo("<p clas='msgError'>".$_SESSION['msgError']."</p>");
        $_SESSION['msgError'] = "";
      ?>
    </form>
    <div id="hint">Copyright...</div>
  </body>
</html>