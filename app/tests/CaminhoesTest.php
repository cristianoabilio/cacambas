<?php

class CaminhoesTest extends TestCase {


    public function testEmptyFields(){

        $this->call('POST', '/backend/caminhoes/adicionar');
        $this->assertEquals('{"status":"error","msg":{"validation_errors":["Preencha o campo marca.","Preencha o campo modelo.","Preencha o campo placa."]}}',$this->client->getResponse()->getContent());
    }


    public function testAdd(){

        $this->call('POST', '/backend/caminhoes/adicionar',array());

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testUpdate(){
        $response = $this->call('POST', '/backend/caminhoes/editar');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testDelete(){
        $response = $this->call('POST', '/backend/caminhoes/excluir',array('id'=>'1'));
        $this->assertTrue($this->client->getResponse()->isOk());
    }
}