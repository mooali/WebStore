
<?php
class User
{
	private $id;
	private $username;
	private $email;
	private $pwd;
	private $type
	;
	public function getID()
	{
			return $this->id;
	}

	public function getUsername()
	{
			return $this->username;
	}
	public function getEmail()
	{
			return $this->email;
	}
	public function getPwd()
	{
			return $this->pwd;
	}
	public function getType()
	{
			return $this->type;
	}






	public function __toString()
	{
			return sprintf("%d) %s %s %s", $this->id, $this->username, $this->email, $this->type);
	}



	static public function insert($values)
	{
		$name = $values['username'];
		$password = md5($values['pwd']);
			if ($stmt = DB::getInstance()->prepare("INSERT INTO users (username, email , pwd, type) VALUE (?,?,?,?)")) {
					if ($stmt->bind_param('ssss', $values['username'], $values['email'], $password, $values['type'])) {
							if ($stmt->execute()) {
									return true;
							}
					}
			}
			return false;
	}






	static public function delete($id)
	{
			$id = (int)$id;
			$res = DB::doQuery("DELETE FROM users WHERE id = $id");
			return $res != null;
	}



	public static function checkCredentials($login, $password)
	{
			$password = md5($password); //encrypt the input password
			$users = User::getUser('id');
			foreach ($users as $user) {
					if ($user->username == $login && $user->pwd == $password) {
							return $user;
					}
			}
			return null;
			//return isset(self::$users[$login]) && self::$users[$login] == $password;
	}


	static public function getUser($orderBy = "id")
	{
			$orderByStr = '';
			if (in_array($orderBy, ['id', 'name', 'email', 'password'])) {
					$orderByStr = " ORDER BY $orderBy";
			}
			$users = array();
			$res = DB::doQuery("SELECT * FROM users $orderByStr");
			if ($res) {
					while ($user = $res->fetch_object(get_class())) {
							$users[] = $user;
					}
			}
			return $users;
	}



	public function update($values)
	{
			$db = DB::getInstance();
			$this->username = $db->escape_string($values['username']);
			$this->email = $db->escape_string($values['email']);
			$this->pwd = $db->escape_string($values['pwd']);
			$this->type = $db->escape_string($values['type']);
	}



	public function save()
	{
			$sql = sprintf("UPDATE users SET username='%s', email='%s', pwd='%s', type='%s' WHERE id = %d;", $this->username, $this->email, $this->pwd, $this->type, $this->id);
			$res = DB::doQuery($sql);
			return $res != null;
	}



	static public function getUserById($id)
	{
			$id = (int)$id;
			$res = DB::doQuery("SELECT * FROM users WHERE id = $id");
			if ($res) {
					if ($user = $res->fetch_object(get_class())) {
							return $user;
					}
			}
			return null;
	}


	static public function nameExist($username){
		$res = DB::doQuery("SELECT * FROM users WHERE username = $username");
		return $res;
	}

	static public function emailExist($email){
		$res = DB::doQuery("SELECT * FROM users WHERE email = $email");
		return $res;
	}




	public static function checkName($username){
		if (!preg_match("/^[a-zA-Z ]*$/",$username)){
			 return false;
		} else {
			return true;
		}
	}

	public static function checkEmail($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return false;
		}else {
			return true;
		}
	}


	public static function checkPassword($password){
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);
		if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password)<8) {
			return false;
		}else {
			return true;
		}
	}

}
