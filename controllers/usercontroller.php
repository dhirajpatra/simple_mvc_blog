<?php
class UserController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    /**
     * it will show login form
     * @throws Exception
     */
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->_view->set('title', 'Simple site Login');
            return $this->_view->output();
        } else {
            header('Location: '.ROOT.'/index');
        }

    }

    public function login()
    {
        if (!isset($_POST['loginFormSubmit']))
        {
            header('Location: '.ROOT.'/user/index');
        }

        $errors = array();
        $check = true;

        $userName = isset($_POST['username']) ? trim($_POST['username']) : NULL;
        $password = isset($_POST['password']) ? trim($_POST['password']) : NULL;

        if (empty($userName))
        {
            $check = false;
            array_push($errors, "Username is required!");
        }

        if (empty($password))
        {
            $check = false;
            array_push($errors, "Password is required!");
        }

        if (!$check)
        {
            $this->_setView('index');
            $this->_view->set('title', 'Invalid form data!');
            $this->_view->set('errors', $errors);
            $this->_view->set('formData', $_POST);
            return $this->_view->output();
        }

        try {

            $userDetails = $this->_model->login($userName, $password);

            $this->_view->set('user', $userDetails);
            header('location: ' . ROOT . '/');

        } catch (Exception $e) {
            $this->_setView('index');
            $this->_view->set('title', 'There was an error login!');
            $this->_view->set('formData', $_POST);
            $this->_view->set('saveError', $e->getMessage());
        }

        return $this->_view->output();

    }

    public function logout()
    {
        try {
            if (!isset($_SESSION['user_id'])) {
                header('location: ' . ROOT . '/');
            } else {
                $logout = $this->_model->logout();

                header('location: ' . ROOT . '/');
            }

        } catch (Exception $e) {
            header('location: ' . ROOT . '/');
        }
    }
}