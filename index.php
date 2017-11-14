<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Bitter|Lora|Playfair+Display" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="blogContainer">
		<div class="blogContent">

			<div class="w3-container">
				<button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large">Post Sumthang!!</button>

				<div id="id01" class="w3-modal">
					<div class="w3-modal-content w3-animate-zoom" style="max-width:600px">

						<div class="w3-center"><br>
							<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
						</div>

						<form class="w3-container" action="index.php" method="post">
							<div class="w3-section">
								<label><b>Title</b></label>
								<input class="w3-input w3-border w3-margin-bottom" type="text" name="title" required>
								<label><b>Content</b></label>
								<input class="w3-input-content w3-border w3-margin-bottom" name="content" required>
								<label><b>Username<b></label>
								<input class="w3-input w3-border" name="username" required>
								<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="submit">Post</button>
							</div>
						</form>

						<div class="w3-container w3-border-top w3-padding-16 w3-light-grey" style="text-align: center">
							<button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
						</div>

					</div>
				</div>
			</div>

			<!-->
			<form action="index.php" method="post">
				Title:
				<input type="text" name="title">
				Content:
				<input type="text" name="content">
				Username:
				<input type="text" name="username">
				<input type="submit" name="submit">
			</form>
			<!-->

			<?php 
			$dbh = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", "root", "");

			if (isset($_POST['submit'])) {

				$sql = "insert into post(username, title, content)
				values ('" . $_POST['username'] . "', '" . $_POST['title'] . "', '" . $_POST['content']. "' )";
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
			}

			$sql = "select * from post order by postdate DESC"; 	
			$stmt = $dbh->prepare($sql); 
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				//echo "<pre>" . print_r($row,1) . "</pre>";
				echo "<h1> {$row['title']} </h1>";
				echo "<p> {$row['content']} </p>";
				echo "<small> {$row['username']} </small> <br>"; 
				echo "<small> {$row['postdate']} </small>";
			}

			?>
		</div>
	</div>
</body>
</html>
