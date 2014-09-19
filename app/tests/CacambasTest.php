<?php

// class CacambasTest extends TestCase {


//     public function testEmptyFields(){

//         $this->call('POST', '/backend/cacambas/adicionar');
//         $this->assertEquals('',$this->client->getResponse()->getContent());
//     }


//     public function testAdd(){

//         $this->call('POST', '/backend/cacambas/adicionar',array());

//         $this->assertTrue($this->client->getResponse()->isOk());
//     }

//     public function testUpdate(){
//         $response = $this->call('POST', '/backend/cacambas/editar');
//         $this->assertTrue($this->client->getResponse()->isOk());
//     }

//     public function testDelete(){
//         $response = $this->call('POST', '/backend/cacambas/excluir',array('id'=>'1'));
//         $this->assertTrue($this->client->getResponse()->isOk());
//     }
// }