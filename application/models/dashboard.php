<?php
class Dashboard extends CI_Model {
	function add($user_data)
	{
		$query = "INSERT INTO users(first_name, last_name, user_name, email_address, password, user_level, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?)";
		$values = array($user_data['first_name'], $user_data['last_name'], $user_data['user_name'], $user_data['email'], $user_data['password'], 2, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
		return $this->db->query($query, $values);
	}
	function check($user_data)
	{
		$query = "SELECT DATE_FORMAT(users.created_at, '%M %D %Y') AS time, users.* FROM users WHERE '{$user_data['user_name']}' = users.user_name AND '{$user_data['password']}' = users.password";
		return $this->db->query($query)->row_array();
	}
	function get_user_by_id($id)
	{
		$query = "SELECT DATE_FORMAT(users.created_at, '%M %D %Y') AS time, users.* FROM users WHERE {$id} = users.id";
		return $this->db->query($query)->row_array();
	}
	function all()
	{
		$query = "SELECT DATE_FORMAT(users.created_at, '%M %D %Y') AS time, users.* FROM users";
		return $this->db->query($query)->result_array();
	}
		function admin_update_user_info($user_info)
	{
		$query = "UPDATE users SET users.email_address ='{$user_info['email']}', users.user_name ='{$user_info['user_name']}', users.first_name ='{$user_info['first_name']}', users.last_name ='{$user_info['last_name']}', users.user_level = {$user_info['level']}
		WHERE users.id = {$user_info['id']}";
		return $this->db->query($query);
	}
	function update_user_info($user_info)
	{
		$query = "UPDATE users SET users.email_address ='{$user_info['email']}', users.first_name ='{$user_info['first_name']}', users.last_name ='{$user_info['last_name']}'
		WHERE users.id = {$user_info['id']}";
		return $this->db->query($query);
	}
	function update_password($user_info)
	{
		$query = "UPDATE users SET users.password ='{$user_info['password']}', users.password ='{$user_info['password']}'
		WHERE users.id = {$user_info['id']}";
		return $this->db->query($query);
	}
	function update_description($user_info)
	{
		$query = "UPDATE users SET users.description ='{$user_info['description']}'
		WHERE users.id = {$user_info['id']}";
		return $this->db->query($query);
	}
	function delete_user_by_id($id)
	{
		$query = "DELETE FROM users WHERE {$id} = users.id";
		return $this->db->query($query);
	}
	function insert_message($message)
	{
		$query = "INSERT INTO messages( message, created_at, updated_at, users_id, creator_id) VALUES(?,?,?,?,?)";
		$values = array($message['message'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"), $message['user_id'], $message['creator_id']);
		return $this->db->query($query, $values);
	}
	function get_messages_by_id($id)
	{
		$query = "SELECT DATE_FORMAT(messages.created_at, '%M %D %Y') AS time, messages.*, creator.user_name AS creator_name, creator.id AS creator_id FROM messages 
			JOIN users AS creator ON creator.id = messages.creator_id WHERE {$id} = messages.users_id ORDER BY messages.created_at DESC";
		return $this->db->query($query)->result_array();
	}
	function insert_comment($comment)
	{
		$query = "INSERT INTO comments(comment, created_at, updated_at, users_id, messages_id, creator_id) VALUES(?,?,?,?,?,?)";
		$values = array($comment['comment'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"), $comment['user_id'], $comment['message_id'], $comment['creator_id']);
		return $this->db->query($query, $values);
	}
	function get_comments_by_id($id)
	{
		$query = "SELECT DATE_FORMAT(comments.created_at, '%M %D %Y') AS time, comments.*, comments.messages_id as id, creator.user_name AS creator_name, creator.id AS creator_id FROM comments 
			JOIN users AS creator ON creator.id = comments.creator_id 
			JOIN messages ON comments.messages_id = messages.id WHERE {$id} = comments.users_id AND comments.messages_id = messages.id ORDER BY comments.created_at";
		return $this->db->query($query)->result_array();
	}
	
}

?>