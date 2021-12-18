<!--Exercise from Chapter 6. File MessageBoard.php and folder MessageBoard must be in the same directory in order to run properly. Needs XAMPP HTTP server installed to run-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Post Message</title>
</head>
<body style="background-color: lightgreen;">
	<!-- Add PHP BLOCK here -->
	<?php
		if(isset($_POST["submit"])){
			$Subject = stripslashes($_POST["subject"]);
			$Name = stripslashes($_POST["name"]);
			$Message = stripslashes($_POST["message"]);

			// Replace any '~' with '-' characters
			$Subject = str_replace("~", "-", $Subject);
			$Name = str_replace("~", "-", $Name);
			$Message = str_replace("~", "-", $Message);

			$MessageRecord = "$Subject~$Name~$Message\n";

			// Let's create a variable to store a new open file's data
			$MessageFile = fopen("MessageBoard/messages.txt", "ab");

			// Check that there are no issues with the file before writing a new message to it
			if($MessageFile === FALSE) {
				echo "There was an error in saving your message!\n";
			}
			else {
				fwrite($MessageFile, $MessageRecord);
				fclose($MessageFile);
				echo "Your message has been saved!\n";
			}

		}// end of main if statement
	?>

	<h1>Post New Message</h1>
	<hr/>
	<form action="PostMessage.php" method="POST">
		<label style="font-weight: bold;">Subject:</label>
		<input type="text" name="subject" />
		<label style="font-weight: bold;">Name:</label>
		<input type="text" name="name" />
		<br/>
		<textarea name="message" rows="6" cols="80" style="resize:none;"></textarea><br/>
		<input type="submit" name="submit" value="Post Message" />
		<input type="reset" name="reset" value="Reset Form" />
	</form>
	<br/>
	<hr/>
	<p><a href="MessageBoard.php">View Messages</a><p/>

</body>
</html>