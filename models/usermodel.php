<?php

/**
 * Class IndexModel
 */
class UserModel extends Model
{
    /**
     * @return array|bool
     * @throws Exception
     */
    public function login($userName, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE username = ?";
            $this->_setSql($sql);
            $userDetails = $this->getRow(array($userName));
            if (!empty($userDetails) && (password_verify($password, $userDetails['password'])))
            {
                $_SESSION['user_id'] =  $userDetails['id'];
                $_SESSION['user_name'] =  $userDetails['username'];
                $_SESSION['user_email'] =  $userDetails['email'];

                //print_r($_SESSION); exit;
                return $userDetails;
            }

            return false;

        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    /**
     * now only session based login
     * later can be db based
     */
    public function logout()
    {
        try {
            session_destroy();

            return true;
        } catch (Exception $e) {
            die('Logout failed: ' . $e->getMessage());
        }
    }
}