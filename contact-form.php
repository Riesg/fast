<?php
$name= $_POST['name'];
$emailHelp= $_POST['email'];
$phone= $_POST['phone'];
$comments=$_POST['comments'];

if(isset($name) && isset($emailHelp) && isset($phone))
{
	global $to_email,$vpb_message_body,$headers;
	$to_email="fastwaylogistica@outlook.com";
	$vpb_message_body = nl2br("Caro Admin,\n
	O usuário cujos detalhes são mostrados abaixo enviou esta mensagem de ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	
	Nome: ".$name."\n
	Email : ".$emailHelp."\n
	Telefone: ".$phone."\n
	Menssagem: ".$comments."\n
	User Ip:".getHostByName(getHostName())."\n
	Obrigado!\n\n");
	
	//Set up the email headers
    $headers    = "From: $name <$emailHelp>\r\n";
    $headers   .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers   .= "Message-ID: <".time().rand(1,1000)."@".$_SERVER['SERVER_NAME'].">". "\r\n"; 
   
	 if(@mail($to_email, $vpb_message_body, $headers))
		{
			$status='Sucesso';
			//Displays the success message when email message is sent
			$output="Congrats ".$name.", sua mensagem de e-mail foi enviada com sucesso! Entraremos em contato com você o mais breve possível. Obrigado.";
		} 
		else 
		{
			$status='error';
			 //Displays an error message when email sending fails
			$output="Desculpe, não foi possível enviar seu e-mail no momento. Tente novamente ou entre em contato com o administrador do site para relatar esta mensagem de erro se o problema persistir. Obrigado.";
		}	
}
else
{
	echo $name;
	$status='error';
	$output="preencha os campos obrigatórios";
}

echo json_encode(array('status'=> $status, 'msg'=>$output));
?>