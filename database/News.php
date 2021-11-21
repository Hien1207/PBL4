<?php 
	
class News
{
	private $id_news;
	private $user_id;
	private $content;
	private $title;
	private $file_name;
	private $created_on;
	protected $connect;

	public function setNewsId($id_news)
	{
		$this->id_news = $id_news;
	}

	function getNewsId()
	{
		return $this->id_news;
	}

	function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}

	function getUserId()
	{
		return $this->user_id;
	}
	function setTitle($title)
	{
		$this->title = $title;
	}

	function getTitle()
	{
		return $this->title;
	}
	function setContent($content)
	{
		$this->content = $content;
	}

	function getContent()
	{
		return $this->content;
	}

	function setFileName($file_name)
	{
		$this->file_name=$file_name;
	}

    function getFileName()
	{
		return $this->file_name;
	}

	function setCreatedOn($created_on)
	{
		$this->created_on = $created_on;
	}

	function getCreatedOn()
	{ 
		return $this->created_on;
	}

	public function __construct()
	{
		require_once("Database_connection.php");

		$database_object = new Database_connection;

		$this->connect = $database_object->connect();
	}
    
	function getIdMax()
	{
		$query = "
        select MAX(id_news) from news  ";

		$statement = $this->connect->prepare($query);

		$statement->execute();

		while ($result = $statement->fetchAll())
		{
			return $result["id_news"];

		}
	}
	function save_News()
	{
		$query = "
		INSERT INTO news 
			(user_id, title, content,file_name, created_on) 
			VALUES (:user_id, :title, :content, :file_name, :created_on)
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':user_id', $this->user_id);

		$statement->bindParam(':title', $this->title);

		$statement->bindParam(':content', $this->content);

		$statement->bindParam(':file_name', $this->file_name);

		$statement->bindParam(':created_on', $this->created_on);

		$statement->execute();
	}

	function delete_News(String $id)
	{
		$query = "
		DELETE FROM news where id_news = :id_news
		";

		$statement = $this->connect->prepare($query);

		$statement->bindParam(':id_news', $id);

		$statement->execute();
	}
	function get_all_news_data()
	{
		$query = "
		SELECT * FROM news 
			INNER JOIN chat_user_table 
			ON chat_user_table.user_id = news.user_id 
			ORDER BY news.id_news DESC
		";

		$statement = $this->connect->prepare($query);

		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}


}
	
?>