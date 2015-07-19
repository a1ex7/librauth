<?php
/**
 * Created by PhpStorm.
 * User: TAlex
 * Date: 17.07.2015
 * Time: 10:31
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    public function testGuestRedirect()
    {
        $this->visit('/users')
            ->seePageIs('/auth/login');
    }

    public function testNewUserRegistration()
    {
        $this->artisan('migrate:refresh');
        $this->visit('/auth/register')
            ->type('Michael', 'firstname')
            ->type('Taylor', 'lastname')
            ->type('mt@email.com', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/books');
    }

    public function testIsNewUserInDatabase()
    {
        // check existing user witch created in previous test

        $this->seeInDatabase('users', ['email' => 'mt@email.com']);
    }

    public function testAuthorizeNewUser()
    {
        $user = factory('App\User', 1)->create();
        $this->be($user);
        $this->visit('/users')
            ->seePageIs('/users');
    }

    public function testUserShow()
    {
        $this->withoutMiddleware()
                ->visit('users/1');
        $this->assertViewHas('user');
    }

    public function testUserCreate()
    {
        $user = App\User::firstOrFail();
        $this->be($user);
        $this->visit('users/create')
            ->type('SomeName', 'firstname')
            ->type('SomeLastname', 'lastname')
            ->type('some-mail@email.com', 'email')
            ->press('Save')
            ->seePageIs('/users');
        $this->assertSessionHas('message');
    }

}