<?php

class User
{
    public function __call($name, $arguments) //magic function
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        } else {
            throw new Exception("User::call() ->$name,function unavailable");
        }
    }

    public static function signup($user, $pass, $email, $phone)
    {

        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn = DataBase::getConnection();
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `block`, `active`)
        VALUES ('$user', '$pass', '$email', '$phone', '0', '1')";
        $error = false;
        if ($conn->query($sql) === true) {
            $error = false;
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            $error = $conn->error;
        }

        $conn->close();
        return $error;
    }
    public static function validate_credentials($user, $pass)
    {

        $query = "SELECT * FROM `auth` WHERE `username` = '$user'";
        $conn = DataBase::getConnection();
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // if ($row['password'] == $pass) {
            if (password_verify($pass, $row['password'])) {
                return $row['username'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function __construct($username)
    {
        //TODO: Write the code to fetch user data from Database for the given username. If username is not present, throw Exception.
        $this->conn = DataBase::getConnection();
        $this->username = $username;
        $this->id = null;
        $sql = "SELECT `id` FROM `auth` WHERE `username`= '$username' OR 'id = '$username'  LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->id = $row['id']; //Updating this from database
        } else {
            echo ("Username does't exist");
        }
    }
    private function _get_data($var)
    {
        if (!$this->conn) {
            $this->conn = DataBase::getConnection();
        }
        $sql = "SELECT `$var` FROM `users` WHERE `id` = $this->id";
        $result = $this->conn->query($sql);
        if ($result and $result->num_rows == 1) {
            //print("Res: ".$result->fetch_assoc()["$var"]);
            return $result->fetch_assoc()["$var"];
        } else {
            return null;
        }
    }
    private function _set_data($var, $data)
    {
        if (!$this->conn) {
            $this->conn = DataBase::getConnection();
        }
        $sql = "UPDATE `users` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function authenticate() {}
}
