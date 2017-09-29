<?php
class database{
	
	static public function connect(){
		$db_host = "localhost";
		$db_name = 'egrettv';
		$db_user = "root";
		$db_pass = '';
		$con = new PDO( "mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass );
		$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		return $con;
	}
}

class Users {
public $email = null;
public $pass = null;
public $password1 = null;
public $first_name = null;
public $last_name = null;
public $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";
public $user_id = null;

public function __construct( $data = array() ) {
if( isset( $data['email'] ) ) $this->email = stripslashes( strip_tags( $data['email'] ) );
if( isset( $data['pass'] ) ) $this->pass = stripslashes( strip_tags( $data['pass'] ) );
if( isset( $data['first_name'] ) ) $this->first_name = stripslashes( strip_tags( $data['first_name'] ) );
if( isset( $data['last_name'] ) ) $this->last_name = stripslashes( strip_tags( $data['last_name'] ) );
if( isset( $data['password1'] ) ) $this->password1 = stripslashes( strip_tags( $data['password1'] ) );
}

public function storeFormValues( $params ) {
//store the parameters
$this->__construct( $params );
}

public function userLogin() {

$success = false;
try{

$con = database::connect();
		
$sql = "SELECT * FROM users WHERE email = :email AND pass = :pass AND active IS NULL LIMIT 1";

// stops sql injection
$stmt = $con->prepare( $sql );
$stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
$stmt->bindValue( "pass", hash("sha1", $this->pass), PDO::PARAM_STR );
$stmt->execute();

$valid = $stmt->fetch(PDO::FETCH_ASSOC);

if( $valid ) {
$_SESSION = $valid;
$success = true;
}

$con = null;
return $success;
}catch (PDOException $e) {
echo $e->getMessage();
return $success;
}
}

public function userEmail() {
echo "email2 " . $this->email . "<br>";
$success = false;
try{
$con = database::connect();

$sql = "SELECT * FROM users WHERE email = :email AND active is NULL LIMIT 1";

$stmt = $con->prepare( $sql );
$stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
$stmt->execute();

$valid = $stmt->fetch(PDO::FETCH_ASSOC);
if( $valid ) {
$this->user_id = $valid['user_id'];
$success = true;
}

$con = null;
return $success;
}catch (PDOException $e) {
echo $e->getMessage();
return $success;
}
}

public function userRegister($active) {

$success = false;
try{
$con = database::connect();

$sql = "INSERT INTO users(email, pass, first_name, last_name, active, registration_date) 
VALUES (:email, :password1, :first_name, :last_name, :active, NOW())";

$stmt = $con->prepare( $sql );
$stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
$stmt->bindValue( "password1", hash("sha1", $this->password1), PDO::PARAM_STR );
$stmt->bindValue( "first_name", $this->first_name, PDO::PARAM_STR );
$stmt->bindValue( "last_name", $this->last_name, PDO::PARAM_STR );
$stmt->bindValue( "active", $active, PDO::PARAM_STR );

$stmt->execute();

$success = true;

$con = null;
return $success;
}catch (PDOException $e) {
echo $e->getMessage();
return $success;
}
}

public function userForgot($p) { 

$success = false;
try{
$con = database::connect();

//$sql = "UPDATE users  SET pass=SHA1('$p') WHERE user_id = :user_id LIMIT 1";
$sql = "UPDATE users  SET pass = :pass WHERE user_id = :user_id LIMIT 1";

$stmt = $con->prepare( $sql );
$stmt->bindValue( "pass", hash("sha1", $p), PDO::PARAM_STR );
$stmt->bindValue( "user_id", $this->user_id, PDO::PARAM_STR );

$stmt->execute();

$success = true;

$con = null;
return $success;
}catch (PDOException $e) {
echo $e->getMessage();
return $success;
}
}

public function userActivate($e, $active) { 

$success = false;
try{
$con = database::connect();

$sql = "UPDATE users SET active=NULL WHERE (email=:email AND active=:active) LIMIT 1";
//$sql = "SELECT * FROm users WHERE (email=:email AND active=:active) LIMIT 1";


$stmt = $con->prepare( $sql );

$stmt->bindValue( "email", $e, PDO::PARAM_STR );
$stmt->bindValue( "active", $active, PDO::PARAM_STR );

$stmt->execute();

//$valid = $stmt->fetch(PDO::FETCH_ASSOC);

//if( $valid ) {

$success = true;
//}

$con = null;
return $success;
}catch (PDOException $e) {
echo $e->getMessage();
return $success;
}
}

public function userDelete() { 

$success = false;
try{
$con = database::connect();

//$sql = "UPDATE users  SET pass=SHA1('$p') WHERE user_id = :user_id LIMIT 1";
$sql = "DELETE FROM users  WHERE user_id = :user_id";

$stmt = $con->prepare( $sql );

$stmt->bindValue( "user_id", $this->user_id, PDO::PARAM_STR );

$stmt->execute();

$success = true;

$con = null;
return $success;
}catch (PDOException $e) {
echo $e->getMessage();
return $success;
}
}

}
?>

