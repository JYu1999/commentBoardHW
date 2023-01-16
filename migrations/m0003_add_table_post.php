<?php

class m0003_add_table_post{
    public function up()
    {
       $db = \app\core\Application::$app->db;
       $SQL = "CREATE TABLE posts(
            id INT AUTO_INCREMENT PRIMARY KEY,
            subject VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
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