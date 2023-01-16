<?php

class m0003_add_table_post{
    public function up()
    {
       $db = \app\core\Application::$app->db;
       $SQL = "CREATE TABLE posts(
            post_id INT AUTO_INCREMENT PRIMARY KEY,
            subject VARCHAR(255) NOT NULL,
            body TEXT NOT NULL,
            created_by INT,
            FOREIGN KEY (created_by) REFERENCES users(id), 
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
       $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE posts";
        $db->pdo->exec($SQL);
    }
}