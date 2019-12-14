
<?php
$errors = array(); // An array holding the form errors
// Validate form
if (count($_POST) > 0) {
  // Validate email
  if (!isset($_POST['email'])
    || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Please enter a valid e-mail address!';
  }
}
if (count($_POST) > 0 && count($errors) == 0) {
  // A valid form (name and email) has been submitted!
  echo "<p>Thank you " . $_POST['firstName'] . "!</p>";
} else {
  // Display the form
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $e_email = isset($errors['email']) ? $errors['email'] :'';
?>
<?php } ?>
