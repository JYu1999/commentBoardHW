<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;
use app\core\Model;

class ContactForm extends DbModel
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';
    public int $created_by=0;

    public function tableName(): string
    {
        // TODO: Implement tableName() method.
        return 'posts';
    }
    public function attributes(): array
    {
        // TODO: Implement attributes() method.
        return ['subject', 'body', 'created_by'];
    }
    public function primaryKey(): string
    {
        // TODO: Implement primaryKey() method.
        return 'post_id';
    }

    public function rules():array
    {
        return [
            'subject' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max'=>25]],
//            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body'=>[self::RULE_REQUIRED]
        ];
    }

    public function labels():array
    {
        return [
            'subject' =>'Enter your subject',
//            'email' =>'Your email',
            'body'=>'Body'
        ];
    }

    public function send()
    {
        echo '<pre>';
        var_dump(Application::$app->user->id);
        echo '</pre>';
        //exit;
        $this->created_by = Application::$app->user->id;
        return parent::save();
    }
}