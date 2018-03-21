<?php
class IndexController extends Controller
{
    /**
     * IndexController constructor.
     * @param $model
     * @param $action
     */
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
	}

    /**
     * @param null $query
     */
	public function index($query = null)
	{
		try {
            if ($query != null) {
                $query = explode('=', $query);
                //print_r($query); exit;
                $page = $query[1];
            } else {
                $page = 1;
            }

			$articles = $this->_model->getNews($page);
			$this->_view->set('articles', $articles);
			$this->_view->set('title', 'Blog Posts');

			return $this->_view->output();

		} catch (Exception $e) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}

    /**
     * @param $articleId
     */
	public function details($articleId)
	{
		try {

            if (!isset($_SESSION['user_id'])) {
                header('location: ' . ROOT . '/user/login');
            }

			$article = $this->_model->getArticleById((int)$articleId);

			if ($article)
			{
                $this->_view->set('articleId', $article['id']);
				$this->_view->set('title', $article['title']);
				$this->_view->set('articleBody', $article['article']);
				$this->_view->set('datePublished', $article['date']);
				$this->_view->set('author', $article['username']);
                $this->_view->set('ip', $article['ip']);
                $this->_view->set('userId', $article['user_id']);
                if (isset($article['comments'])) {
                    $this->_view->set('comments', $article['comments']);
                } else {
                    $this->_view->set('comments', array());
                }

			}
			else
			{
				$this->_view->set('title', 'Invalid article ID');
				$this->_view->set('noArticle', true);
			}

			return $this->_view->output();

		} catch (Exception $e) {
			echo '<h1>Application error:</h1>' . $e->getMessage();
		}
	}

    /**
     * @throws Exception
     */
    public function add()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->_view->set('title', 'Simple site Login');
            return $this->_view->output();
        } else {
            $this->_view->set('title', 'Article Submission');
            return $this->_view->output();
        }
    }

    /**
     * @throws Exception
     */
    public function update($articleId)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->_view->set('title', 'Simple site Login');
            return $this->_view->output();
        } else {
            // fetch all data
            $article = $this->_model->getArticleById((int)$articleId);
            //print_r($article); exit;
            if ($article)
            {
                $this->_setView('edit');

                $this->_view->set('id', $article['id']);
                $this->_view->set('title', $article['title']);
                $this->_view->set('article', $article['article']);
                $this->_view->set('intro', $article['intro']);
            }

            $this->_view->set('title', 'Article Edit!');
            return $this->_view->output();
        }
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: ' . ROOT . '/user/login');
        }

        if (!isset($_POST['articleFormSubmit']))
        {
            header('Location: '.ROOT.'/index');
        }

        $errors = array();
        $check = true;

        $title = isset($_POST['title']) ? trim($_POST['title']) : NULL;
        $intro = isset($_POST['intro']) ? trim($_POST['intro']) : NULL;
        $article = isset($_POST['article']) ? trim($_POST['article']) : NULL;

        if (empty($title))
        {
            $check = false;
            array_push($errors, "Title is required!");
        }

        if (empty($intro))
        {
            $check = false;
            array_push($errors, "Intro is required!");
        }

        if (empty($article))
        {
            $check = false;
            array_push($errors, "Article is required!");
        }

        if (!$check)
        {
            $this->_setView('add');
            $this->_view->set('title', 'Invalid form data!');
            $this->_view->set('errors', $errors);
            $this->_view->set('formData', $_POST);
            return $this->_view->output();
        }

        try {
            $data = array(
                $title,
                $intro,
                $article,
                date('Y-m-d H:i:s'),
                'Y',
                $_SESSION['user_id'],
                $this->get_client_ip()
            );
            $result = $this->_model->add($data);

            header('location: ' . ROOT . '/index');

        } catch (Exception $e) {
            $this->_setView('index');
            $this->_view->set('title', 'There was an error save!');
            $this->_view->set('formData', $_POST);
            $this->_view->set('saveError', $e->getMessage());
        }

        return $this->_view->output();
    }

    /**
     * @throws Exception
     */
    public function updatesave()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: ' . ROOT . '/user/login');
        }

        if (!isset($_POST['articleFormSubmit']))
        {
            header('Location: '.ROOT.'/index');
        }

        $errors = array();
        $check = true;

        $id = isset($_POST['id']) ? trim($_POST['id']) : NULL;
        $title = isset($_POST['title']) ? trim($_POST['title']) : NULL;
        $intro = isset($_POST['intro']) ? trim($_POST['intro']) : NULL;
        $article = isset($_POST['article']) ? trim($_POST['article']) : NULL;

        if (empty($title))
        {
            $check = false;
            array_push($errors, "Title is required!");
        }

        if (empty($intro))
        {
            $check = false;
            array_push($errors, "Intro is required!");
        }

        if (empty($article))
        {
            $check = false;
            array_push($errors, "Article is required!");
        }

        if (!$check)
        {
            $this->_setView('edit');
            $this->_view->set('title', 'Invalid form data!');
            $this->_view->set('errors', $errors);
            $this->_view->set('formData', $_POST);
            return $this->_view->output();
        }

        try {
            $data = array(
                $title,
                $intro,
                $article,
                date('Y-m-d H:i:s'),
                'Y',
                $_SESSION['user_id'],
                $this->get_client_ip(),
                $id
            );
            $result = $this->_model->update($data);

            header('location: ' . ROOT . '/index');

        } catch (Exception $e) {
            $this->_setView('index');
            $this->_view->set('title', 'There was an error save!');
            $this->_view->set('formData', $_POST);
            $this->_view->set('saveError', $e->getMessage());
        }

        return $this->_view->output();
    }

    /**
     * @param $articleId
     * @throws Exception
     */
    public function delete($articleId)
    {
        try {
            if (!isset($_SESSION['user_id'])) {
                header('location: ' . ROOT . '/user/login');
            }

            $result = $this->_model->delete($articleId);

            if ($result) {
                header('location: ' . ROOT . '/index');
            } else {
                echo 'hee';
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    

    /**
     * @throws Exception
     */
    public function comment()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: ' . ROOT . '/user/login');
        }

        if (!isset($_POST['commentFormSubmit']))
        {
            header('Location: '.ROOT.'/index');
        }

        $errors = array();
        $check = true;

        $id = isset($_POST['article_id']) ? trim($_POST['article_id']) : NULL;
        $userName = isset($_POST['username']) ? trim($_POST['username']) : NULL;
        $remark = isset($_POST['remark']) ? trim($_POST['remark']) : NULL;

        if (empty($id))
        {
            $check = false;
            array_push($errors, "ID is required!");
        }

        if (empty($userName))
        {
            $check = false;
            array_push($errors, "UserName is required!");
        }

        if (empty($remark))
        {
            $check = false;
            array_push($errors, "Remark is required!");
        }

        if (!$check)
        {
            $this->_setView('add');
            $this->_view->set('title', 'Invalid form data!');
            $this->_view->set('errors', $errors);
            $this->_view->set('formData', $_POST);
            return $this->_view->output();
        }

        try {
            $data = array(
                $remark,
                $id,
                $_SESSION['user_id']
            );
            $result = $this->_model->comment($data);

            header('location: ' . ROOT . '/index/details/'.$id);

        } catch (Exception $e) {
            $this->_setView('index');
            $this->_view->set('title', 'There was an error login!');
            $this->_view->set('formData', $_POST);
            $this->_view->set('saveError', $e->getMessage());
        }

        return $this->_view->output();
    }

    /**
     * @return string
     */
    private function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if(getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if(getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if(getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if(getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if(getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else if($_SERVER['REMOTE_ADDR']) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
	
}