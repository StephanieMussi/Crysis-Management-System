<?php
	include('../classes/userController.php');


	if(isset($_POST['btn_submit'])){
	
		$username = $_POST['username'];
		$password = $_POST['password'];
        $userController = new userController();
        $type = $userController->verifyUser($username,$password);

        if ($type != false) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['type'] = $type;
            if ($type == "agency") {
                header("Location: ../agency/agency_main.php");
                exit();
            } else if ($type == "cco") {
                header("Location: ../cco/cco_main.php");
                exit();
            } else if ($type == "pmo") {
                header("Location: ../pmo/pmo_main.php");
                exit();
            }

            if ($type == "cmo") {
                header("Location: ../cmo/cmo_main.php");
                exit();
            } else if ($type = "sqlError") {
                header("Location: ../public/public_login.php?error=sqlError&username=" . $username);
                exit();
            }
        }
        else
            {
                header("Location: ../public/public_login.php?error=loginError&username=" . $username);
                exit();
            };



        /*
		//try agency
		$agencyController = new agency_usersController();
		$isAgency = $agencyController->verifyUser($username, $password);

		
		if($type == "agency"){
			session_start();
			$_SESSION['username'] = $username;		
			$_SESSION['type'] = 'agency';
			header("Location: ../agency/agency_main.php");
			exit();
		}
		else if($isAgency == "sqlError"){
			header("Location: ../public/public_login.php?error=sqlError&username=".$username);
			exit();
		}
		else{
			//try cco
			$ccoController = new cco_usersController();
			$isCco = $ccoController->verifyUser($username, $password);

			if($isCco == true){
				session_start();
				$_SESSION['username'] = $username;
				$_SESSION['type'] = 'cco';
				header("Location: ../cco/cco_main.php");
				exit();
			}
			else if($isCco == "sqlError"){
				header("Location: ../public/public_login.php?error=sqlError&username=".$username);
				exit();
			}
			else{
				//try cmo
				$cmoController = new cmo_usersController();
				$isCmo = $cmoController->verifyUser($username, $password);

				if($isCmo == true){
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION['type'] = 'cmo';
					header("Location: ../cmo/cmo_main.php");
					exit();
				}
				else if($isCmo == "sqlError"){
					header("Location: ../public/public_login.php?error=sqlError&username=".$username);
					exit();
				}
				else{
					//try pmo
					$pmoController = new pmo_usersController();
					$isPmo = $pmoController->verifyUser($username, $password);

					if($isPmo == true){
						session_start();
						$_SESSION['username'] = $username;
						$_SESSION['type'] = 'pmo';
						header("Location: ../pmo/pmo_main.php");
						exit();
					}
					else if($isPmo == "sqlError"){
						header("Location: ../public/public_login.php?error=sqlError&username=".$username);
						exit();
					}
					else{
						header("Location: ../public/public_login.php?error=loginError&username=".$username);
						exit();
					}
				}
			}

		}*/
	}
	else{
		header("Location: ../public/public_login.php");
	}
?>