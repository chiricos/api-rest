<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class UserTest extends TestCase
{

    //use DatabaseMigrations;

    public function testValidationErrorOnCreateUser()
    {
        $data = $this->getData();
        $this->post('/user', $data)->dump();
    }

    public function testNotFoundUser()
    {
        $this->get('user/10')->seeJsonEquals(['error' => 'Model not found']);
    }


    public function getData($custom = array())
    {
        $data = [
            'name'      => 'joe',
            'email'     => 'joe@doe.com',
            'password'  => '12345'
        ];
        $data = array_merge($data, $custom);
        return $data;
    }
}