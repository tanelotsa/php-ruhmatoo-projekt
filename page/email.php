<?php

if(
    isset($_POST["sender"]) && isset($_POST["reciever"]) && isset($_POST["content"]) &&
    !empty($_POST["sender"]) && !empty($_POST["reciever"]) && !empty($_POST["content"])
){
    var_dump($_POST);

    $to = $_POST["reciever"];
    $subject = "HTML email test";

    $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>This email contains HTML Tags!</p>
        <table>
        <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        </tr>
        <tr>
        <td>John</td>
        <td>Doe</td>
        </tr>
        </table>
        <p>".$_POST["content"]."</p>
        </body>
        </html>
        ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: Greeny Server <'.$_POST["sender"].'>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";


    if(mail($to,$subject,$message,$headers)){
        echo "email sent";
    }else {
        echo "something went wrong";
    }



}
?>
<form method="post">
    <label>Saatja e-post</label><input type="email" name="sender" placeholder="kasutaja@greeny.cs.tlu.ee"><br>
    <label>Saaja e-post</label><input type="email" name="reciever"><br>
    <label>Sisu</label><textarea name="content"></textarea><br>
    <input type="submit">
</form>