<?php
class shareModel extends Model {
    public function Index() {
        $this->query('SELECT * FROM shares');
        $rows = $this->resultSet();
        return $rows;
    }

    public function add() {
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit']) {
            echo 'submitted';
            // Insert into MySQL
            $this->query('INSERT INTO shares (title, body, link, users_id) VALUES(:title, :body, :link, :users_id)');
            $this->bind(':title', $post['title']);
            $this->bind(':body', $post['body']);
            $this->bind(':link', $post['link']);
            $this->bind(':users_id', 2);
            $this->execute();
            //Verify
            if($this->lastInsertId()) {
                // Redirect
                header('Location: ' . ROOT_URL . 'shares');
            }
        }
        return;

    }
}