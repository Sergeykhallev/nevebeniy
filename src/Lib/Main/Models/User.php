<?php
namespace Src\Lib\Main\Models;

class User extends \Src\Lib\Main\DB\Model
{
    public string $table = 'users';

    public array $filliable = [
        'username',
        'email',
        'sex',
        'country'
    ];
}