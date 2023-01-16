<?php

namespace app\models;

use app\core\db\DbModel;
use app\core\Model;

class ContactForm extends DbModel
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function tableName(): string
    {
        // TODO: Implement tableName() method.
        return 'posts';
    }
    public function attributes(): array
    {
        // TODO: Implement attributes() method.
        return ['subject', 'body'];
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
        return parent::save();
    }
}