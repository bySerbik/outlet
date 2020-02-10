<?php


use common\models\User;
use Faker\Factory;

class CreateUserCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function CreateUser()
    {
        $user = $this->imagineCustomerRecord();
        $user->password = Factory::create()->password;

        $username = $user->username;
        $password = $user->password_hash;
        $user->save();


        $user = User::findByUsername($username);
        if (!Yii::$app->security->validatePassword($password, $user->password_hash))
            return false;

    }

    private function imagineCustomerRecord()
    {
        $faker = Factory::create();
        $record = new User();
        $record->username = $faker->name;
        $record->email = $faker->email;
        return $record;
    }
}
