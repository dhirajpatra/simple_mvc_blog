<?php

/**
 * Class IndexModel
 */
class IndexModel extends Model
{

    /**
     * @return array|bool
     * @throws Exception
     */
    public function getNews($page = 1)
    {
        // pagination
        $perpage = PER_PAGE;

        if(isset($page)){
            $page = intval($page);
        }
        else {
            $page = 1;
        }
        $calc = $perpage * $page;
        $start = $calc - $perpage;

        // get total
        $sql = "SELECT
					count(a.id) as total
				FROM 
					articles a
				INNER JOIN users AS u ON u.id = a.user_id
				WHERE a.status = 'Y'";
        $this->_setSql($sql);
        $articlesTotal = $this->getAll();

        if (!empty($articlesTotal) && $articlesTotal[0]['total'] > 0)
        {
            $sql = "SELECT
                        a.id,
                        a.title,
                        a.intro,
                        DATE_FORMAT(a.date, '%d.%m.%Y.') as date,
                        u.username
                    FROM 
                        articles a
                    INNER JOIN users AS u ON u.id = a.user_id
                    WHERE a.status = 'Y'
                    ORDER BY a.date DESC
                    LIMIT $start, $perpage";

            $this->_setSql($sql);
            $articles = $this->getAll();

            if (!empty($articles))
            {
                $i = 0;
                foreach ($articles as $article) {
                    $sql = "SELECT count(id) as cnt FROM comments WHERE article_id = ?";
                    $this->_setSql($sql);
                    $commentDetails = $this->getRow(array($article['id']));
                    if (!empty($commentDetails))
                    {
                        $articles[$i]['comments'] = $commentDetails['cnt'];
                    }
                    $i++;
                }

                $articles['total'] = $articlesTotal[0]['total'];
                $articles['page'] = $page;
                //echo '<pre>'; print_r($articles); exit;
                return $articles;
            }
        }

        return false;
    }

    /**
     * @param $id
     * @return bool|mixed
     * @throws Exception
     */
    public function getArticleById($id)
    {
        $sql = "SELECT
                    a.id,
                    a.user_id,
					a.title,
					a.intro,
					a.article,
					DATE_FORMAT(a.date, '%d.%m.%Y.') as date,
					a.ip,
					u.username
				FROM 
					articles a
				INNER JOIN users AS u ON u.id = a.user_id
				WHERE 
				a.status = 'Y' AND 
					a.id = ? AND 
					u.id = ?";

        $this->_setSql($sql);
        $articleDetails = $this->getRow(array($id, $_SESSION['user_id']));

        if (!empty($articleDetails))
        {
            $sql = "SELECT * FROM comments c 
                  INNER JOIN users u ON u.id = c.user_id 
                  WHERE article_id = ?";
            $this->_setSql($sql);
            $commentDetails = $this->getAll(array($articleDetails['id']));
            if (!empty($commentDetails))
            {
                $articleDetails['comments'] = $commentDetails;
            }

            return $articleDetails;
        }

        return false;
    }

    /**
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        try {
            $sql = "INSERT INTO articles 
					(title, intro, article, date, status, user_id, ip)
 				VALUES 
 					(?, ?, ?, ?, ?, ?, ?)";

            $sth = $this->_db->prepare($sql);
            return $sth->execute($data);

        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    /**
     * @param $data
     * @return bool
     */
    public function update($data)
    {
        try {
            $sql = "UPDATE articles 
					SET title = ?, intro = ?, article = ?, date = ?, status = ?, user_id =?, ip =?
					WHERE id = ?";

            $sth = $this->_db->prepare($sql);
            return $sth->execute($data);

        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool|mixed
     * @throws Exception
     */
    public function delete($id)
    {
        $sql = "UPDATE 
					articles
				SET status = 'N'
				WHERE 
					id = ?";

        $this->_setSql($sql);
        $sth = $this->_db->prepare($sql);

        return $sth->execute(array($id));
    }

    public function comment($data)
    {
        try {
            $sql = "INSERT INTO comments 
					(comment, article_id, user_id)
 				VALUES 
 					(?, ?, ?)";

            $sth = $this->_db->prepare($sql);
            return $sth->execute($data);

        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
}