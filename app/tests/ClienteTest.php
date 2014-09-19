<?php

class ClienteTest extends TestCase {


    public function testEmptyFields(){

        $this->call('POST', '/backend/clientes/adicionar');
        // $this->assertResponseStatus(403);
        $this->assertEquals('{"status":"error","msg":{"validation_errors":["Preencha o campo login id.","Preencha o campo cpf cnpj.","Preencha o campo pj.","Preencha o campo nome."]}}',$this->client->getResponse()->getContent());
    }


    public function testAdd(){

        $this->call('POST', '/backend/clientes/adicionar',array(
                    'cpf_cnpj'=>'123',
                    'nome'=>'123',
                    'pj' => '123',
                    'MAXIPAGO_CUSTOMERID' => '123',
                    'MAXIPAGO_TOKEN' => '123'
                    ));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testUpdate(){
        $response = $this->call('POST', '/backend/clientes/editar');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testDelete(){
        $response = $this->call('POST', '/backend/clientes/excluir',array('id'=>'1'));
        $this->assertTrue($this->client->getResponse()->isOk());
    }
}