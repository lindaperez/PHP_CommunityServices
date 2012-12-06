<?php 
$time_stamp=$argv[1];
$path ="/home/coordpsc/";
$email_from = "paradalvaro@gmail.com"; // Who the email is from 
$email_subject = "Your attached file"; // The Subject of the email 
$email_to = $argv[2];//$_POST["email_to"];//"paradalvaro@gmail.com"; // Who the email is to
$fileatt_type = "application/zip"; // File Type 


$files[0] = $path."respaldo_".$time_stamp."_sql.zip"; // Path to the file  /home/coordpsc
$files[1] = $path."respaldo_".$time_stamp."_SC.zip";
$files[2] = $path."respaldo_".$time_stamp."_Gsc.zip";


foreach($files as $fileatt){

//	$email_message = "Thanks for visiting mysite.com! Here is your free file.";
//	$email_message .= "Thanks for visiting"; // Message that the email has in it

	$headers = "From: ".$email_from;
	$name_array = explode("_",$fileatt); // Filename that will be used for the file as the attachment
	$fileatt_name = $name_array[2]; 

	$file = fopen($fileatt,'rb'); 
	$data = fread($file,filesize($fileatt)); 
	fclose($file);

	$semi_rand = md5(time()); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

	$headers .= "\nMIME-Version: 1.0\n" . 
	"Content-Type: multipart/mixed;\n" . 
	" boundary=\"{$mime_boundary}\"";

	$email_message = "This is a multi-part message in MIME format.\n\n" . 
	"--{$mime_boundary}\n" . 
	"Content-Type:text/html; charset=\"iso-8859-1\"\n" . 
	"Content-Transfer-Encoding: 7bit\n\n" . 
	$email_message .= "\n\n";

	$data = chunk_split(base64_encode($data));

	$email_message .= "--{$mime_boundary}\n" . 
	"Content-Type: {$fileatt_type};\n" . 
	" name=\"{$fileatt_name}\"\n" . 
	//"Content-Disposition: attachment;\n" . 
	//" filename=\"{$fileatt_name}\"\n" . 
	"Content-Transfer-Encoding: base64\n\n" . 
	$data .= "\n\n" . 
	"--{$mime_boundary}--\n";

	$ok = @mail($email_to, $email_subject, $email_message, $headers);

	if($ok) { 
	echo "You file".$fileatt_name." has been sent
	to the email address you specified.

	Make sure to check your junk mail!

	Click here to return to mysite.com.";

	} else { 
	echo "Sorry but the email could not be sent. Please go back and try again!";	//die("Sorry but the email could not be sent. Please go back and try again!"); 
	} 
}
?> 
