<?php

class m0004_add_isAdmin_column_users{
    public function up()
    {
       $db = \app\core\Application::$app->db;
       $SQL = "ALTER TABLE users ADD COLUMN isAdmin BOOL NOT NULL DEFAULT false;";
       $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE users DROP COLUMN isAdmin;";
        $db->pdo->exec($SQL);
    }
}