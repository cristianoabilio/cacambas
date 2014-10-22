<?php

/*class EmpresasTest extends TestCase {


    public function testEmptyFields(){

        $this->call('POST', '/backend/empresas/adicionar');
        $this->assertEquals('{"status":"error","msg":{"validation_errors":["Preencha o campo nome.","Preencha o campo nome fantasia.","Preencha o campo responsavel.","Preencha o campo email.","Preencha o campo telefone."]}}',$this->client->getResponse()->getContent());
    }


    public function testAdd(){

        $this->call('POST', '/backend/empresas/adicionar',array());

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testUpdate(){
        $response = $this->call('POST', '/backend/empresas/editar');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testDelete(){
        $response = $this->call('POST', '/backend/empresas/excluir',array('id'=>'1'));
        $this->assertTrue($this->client->getResponse()->isOk());
    }
}*/