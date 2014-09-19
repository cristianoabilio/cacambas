<?php

class LoginTest extends TestCase {

	public function testRequest()
	{

        $this->call('POST', '/backend/login');
        $this->assertFalse($this->client->getResponse()->isOk());

	}

    public function testLogout()
    {

        $this->call('GET', '/backend/logout');
        $this->assertFalse($this->client->getResponse()->isOk());

    }

    public function testEmptyFields(){

        $this->call('POST', '/backend/login');
        $this->assertEquals('{"success":false,"message":"auth-validator-fail","data":{"validator":{"usuario":["required"],"senha":["required"]}}}',$this->client->getResponse()->getContent());
    }


    public function testAddUser(){
        $this->call('POST', '/backend/usuario/adicionar',array(
                    'login'=>'12345',
                    'senha'=>'123456',
                    'status'=>'1234567'
                    ));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testUpdateUser(){
        $response = $this->call('POST', '/backend/usuario/editar');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testDeleteUser(){
        $response = $this->call('POST', '/backend/usuario/excluir');
        $this->assertTrue($this->client->getResponse()->isOk());
    }
}