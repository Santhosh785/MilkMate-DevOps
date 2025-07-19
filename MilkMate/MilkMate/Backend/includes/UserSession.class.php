<?php

class UserSession
{
    private $conn;
    private $id;
    private $uid;
    private $data;
    private $token;

    public static function authenticate($user, $pass)
    {

        $username = User::validate_credentials($user, $pass);
        if ($username) {
            $user = new User($username);
        }
        if ($username) {
            $conn = DataBase::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 999999) . $ip . $agent . time());
            $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`)
                VALUES ('$user->id', '$token', now(), '$ip', '$agent', '1')";
            if ($conn->query($sql)) {
                Session::set('Session_token', $token);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function authorize($token)
    {
        try {
            $session = new UserSession($token);
            if (isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER["HTTP_USER_AGENT"])) {
                if ($session->isValid() and $session->isActive()) {
                    if ($_SERVER['REMOTE_ADDR'] == $session->getIP()) {
                        if ($_SERVER['HTTP_USER_AGENT'] == $session->getUserAgent()) {
                            return true;
                        } else throw new Exception("User agent does't match");
                    } else throw new Exception("IP does't match");
                } else {
                    $session->removeSession();
                    throw new Exception("Invalid session");
                }
            } else throw new Exception("IP and User_agent is null");
        } catch (Exception $e) {
            return false;
        }
    }


    public function __construct($token)
    {
        $this->conn = DataBase::getConnection();
        $this->token = $token;
        $sql = "SELECT * FROM `session` WHERE `token`= '$token' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid'];
        } else {
            throw new Exception("Session is Invalid .");
        }
    }

    public function getUserId()
    {
        return $this->uid;
    }
    public function isValid()
    {
        if (isset($this->data['login_time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
            if (3600 > time() - $login_time->getTimestamp()) {
                return true;
            } else {
                return false;
            }
        } else throw new Exception("login tiem is null");
    }

    public function getIP()
    {
        return isset($this->data["ip"]) ? $this->data["ip"] : false;
    }

    public function getUserAgent()
    {
        return isset($this->data["user_agent"]) ? $this->data["user_agent"] : false;
    }

    public function deactivate()
    {
        if (!$this->conn)
            $this->conn = DataBase::getConnection();
        $sql = "UPDATE `session` SET `active` = 0 WHERE `uid`=$this->uid";

        return $this->conn->query($sql) ? true : false;
    }

    public function isActive()
    {
        if (isset($this->data['active'])) {
            return $this->data['active'] ? true : false;
        }
    }

    //This function remove current session
    public function removeSession()
    {
        if (isset($this->data['id'])) {
            $id = $this->data['id'];
            if (!$this->conn) $this->conn = DataBase::getConnection();
            $sql = "DELETE FROM `session` WHERE `id` = $id;";
            if ($this->conn->query($sql)) {
                return true;
            } else return false;
        }
    }
}
