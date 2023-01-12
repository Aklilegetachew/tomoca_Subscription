<?php include  'config/db.php'; ?>
<?php include  'config/functions.php'; ?>
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
  $user_name =  escape($_POST['User_Name']);
  $user_password = escape($_POST['User_Password']);

  $query = "SELECT * FROM admin WHERE UserName = '$user_name' ";
  $select_user = mysqli_query($connection, $query);

  confirm($select_user);

  $row = mysqli_num_rows($select_user);

  if (!empty($row)) {
    while ($data = mysqli_fetch_assoc($select_user)) {
      if (password_verify($user_password, $data['Password'])) {
        $_SESSION['username'] = $data['UserName'];
        $_SESSION['shopname'] = $data['Shop_name'];
        $_SESSION['location'] = $data['Location'];
        $_SESSION['PhoneNum'] = $data['PhoneNumber'];
        $_SESSION['user_role'] = $data['Role'];
        $_SESSION['new_order'] = false;

        header("Location: Dashboard.php");
      } else {
        header("Location: index.php");
      }
    }
  } else {
    header("Location: index.php");
  }
}

session_write_close();







?>