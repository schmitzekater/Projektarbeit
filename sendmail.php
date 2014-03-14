<?php
$sendmail = "From: sender@yourdomain.com\r\n";
mail(
 'carolinschwerdtfeger@gmx.net', // recipient email address
 'Hallo', // email subject
 'Toll', // email body
$sendmail . "\r\n"// additional headers
);
?>