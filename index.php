<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $cellphone = filter_var($_POST['cellphone'], FILTER_SANITIZE_NUMBER_INT);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        $usernameError = "";
        $emailError = "";
        $messageError = "";

        $formErrors = array();

        if (strlen($username) < 4 ) {
            $formErrors[] = 'Username Must Be <strong> Larger Than 3 </strong> Characters!';
        }
        if ($email === "") {
            $formErrors[] = 'Email Can Not Be <strong> Empty! </strong>';
        }
        if (strlen($message) < 10) {
            $formErrors[] = 'Message Must Be <strong> Larger Than 10 </strong> Characters!';
        }
        
        $headers = 'Form: ' . $email . '\n';
        $myEmail = 'mazenkaya445566@gmail.com';
        $subject = 'Contact Form';

        if (empty($formErrors)) {
            mail($myEmail, $subject, $message, $headers);
            $username = '';
            $email = '';
            $cellphone = '';
            $message = '';
            
            $success = '<div class="alert alert-success">Thanks. <strong>We Have Recieved Your Message</strong>. <br> We Will Contact You as Soon as Possible</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>.alert {margin-bottom: 5px !important}</style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-3">Contact us</h2>
        <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            
            <?php if (! empty($formErrors)) { ?>
            <div class="alert alert-danger alert-dimissible" role="start">
                <?php  foreach($formErrors as $error) { echo $error . "<br>"; }?>
            </div>
            <?php };?>
            <?php if (isset($success)) echo $success;?>

            <input class="username form-control mb-2" type="text" name="username"
             value="<?php if (isset($username)) { echo $username; };?>"
             placeholder="Type your name...">
             <div class="username custom-alert alert alert-danger alert-dimissible" role="start">
                Username Must Be Larger Than <strong>3 Characters !</strong>
            </div>

            <input class="email form-control mb-2" type="text" name="email"
             value="<?php if (isset($email)) { echo $email; };?>"
             placeholder="Type your email...">
             <div class="custom-alert alert alert-danger alert-dimissible" role="start">
                Email Can Not Be <strong>Empty !</strong>
            </div>

            <input class="cellphone form-control mb-2" type="number" name="cellphone"
             value="<?php if (isset($cellphone)) { echo $cellphone; };?>"
              placeholder="Type your phone number...">


            <textarea class="message form-control mb-2" name="message"
             value="<?php if (isset($message)) { echo $message; };?>"
              placeholder="Type your message here..."></textarea>
            <div class="custom-alert alert alert-danger alert-dimissible" role="start">
                Message Must Be Larger Than <strong>10 Characters !</strong>
            </div>

            <input class="btn btn-success" type="submit" value="Send a Message">
        </form>
    </div>
    <script src="js/custom.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
</body>
</html>