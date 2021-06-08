<?php

require "../PHPMailer/PHPMailerAutoload.php"; 

$mail = new PHPMailer(); 
$mail->IsSMTP(); 
$mail->Host = 'mail.multicastservicos.co.mz'; 
$mail->SMTPAuth = true; 
$mail->SMTPSecure='tls';

$mail->Username = 'gsenguele@multicastservicos.co.mz'; 
$mail->Password = 'senguele1988'; 
$mail->SMTPSecure ='ssl';
$mail->Port = 465; 

$mail->SMTPOptions = array('ssl' => array( 'verify_peer' =>false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );


// $mail->SMTPDebug = 2; 


$email = $_POST['email'];

$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

$arquivo = "
 <style type='text/css'>
     body {
        margin:0px;
        font-family:times new romans;
        font-size:1.0em;
      color: #000;
    }
    table{
      border: 1px solid #000;
   
}
tr {
    height: 35px;
     text-align: justify;
    font-size: 1.2em;
    letter-spacing: 1px;
    line-height: 1.5;

}
tr, td {
    padding: 15px;
    text-align: justify;
}
td{
  vertical-align: top;
}
  a{
  color: #666666;
  text-decoration: none;
  }
  a:hover {
  color: #FF0000;
  text-decoration: none;
  }
  </style>
    <html>
        <table width='60%' border='0' cellpadding='1' cellspacing='1' bgcolor='#fff'>
            <tr>
              <td>
  <tr>
                 <td width='150'><b>Email:</b></td><td> $email </td>
                </tr>
   
     
    
                
            </td>
          </tr>
          <tr>
            <td width='150'><b>Enviado em </b></td><td>$data_envio às $hora_envio</td>
          </tr>
        </table>
    </html>
  ";

 $mail->setFrom($email,'$nome'); 
$mail->addAddress($email,'Multcast servicos'); 
 
$mail->addReplyTo($email,'$nome');

$mail->IsHTML(true); 

$mail->Subject= 'Trocar password'; 

$mail->Body=$arquivo; 
$enviado=$mail->send();
 if($enviado)
{ 
echo "Email enviado com sucesso";

} else { 
    echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
} 











