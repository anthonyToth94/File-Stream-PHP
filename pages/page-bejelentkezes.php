<?php

//Elmentem az adatokat
$login = false;
$error = "";
$valueName = $valuePassword = "";
$error = false;

//Megírom az algoritmust
if(isset($_POST['submit'])){

	$users = file('data/admin.txt');
	$admin = []; //beleraktam 2 objectet 

	foreach($users as $user)
	{
		$user = trim($user);   
		$sor = explode(";", $user);

		$users = ["username" => "", "password" => ""];

		$users["username"] = $sor[0];
		$users["password"] = $sor[1];

		array_push($admin,$users);
	}
	
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
		
	if(empty($username) || empty($password)){
		$error = "Töltse ki a mezőket!";
	}
	else
	{
		foreach($admin as $a){
			if($username != $a['username'] || $password != $a["password"]){
				$error = "Hibás Felhasználó vagy jelszó!";	
			}else{
				//Beléptél
				$login = true;
				break;
			}
		}
	}
	if($error){
		$valueName = $username;
		$valuePassword = $password;
	}

}

//Kirajzolom a kimenetet
if($login){

$register = file('data/register.txt');

	echo '<table>
			<tr>
				<th>Rendelő</th>	
				<th>E-mail</th>
				<th>Kategória</th>
				<th>Dátum</th>
				<th>Idő</th>
			</tr>';

foreach($register as $r)
{
	$r = trim($r);
	$sor = explode(";", $r);

	$rendelo = $sor[0];
	$email = $sor[1];
	$kategoria = $sor[2];
	$datum = $sor[3];
	$ido = $sor[4];

	echo '<tr>
			<td>'.$rendelo.'</td>
			<td>'.$email.'</td>
			<td>'.$kategoria.'</td>
			<td>'.$datum.'</td>
			<td>'.$ido.'</td>
		</tr>';
}

	echo '</table>';

}else{  ?>

<div class="bejelentkezes">
	<h2>Bejelentkezes </h2>
	<form method="POST"	action=""> <!--Ha üres, akkor itt dolgozza fel! -->
		<div class="row"><span><?php echo $error ?></span></div> 

		<div class="row"><label for="inputName">Felhasználó:</label>
		<input type="text" name="username" id="inputName" maxlength="50" value="<?= $valueName ?>"></div>

		<div class="row"><label for="inputPassword">Jelszo:</label>
		<input type="text" name="password" id="inputPassword" maxlength="50" value="<?= $valuePassword ?>"></div>

		<div class="row"><input type="submit" name="submit" id="submit" value="Küldés"></div>
	</form>
</div>

<?php } ?>

