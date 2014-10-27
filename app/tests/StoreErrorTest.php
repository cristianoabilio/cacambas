<?php

class StoreErrorTest extends TestCase {
	//

	public function testDetected_errors () {

		$response = $this->call('POST', '/classe');
		$expected='{"success":false,"message":"classe-store-error",'
		.'"data":{"nome":["Required field"],"descricao":["Required field"]}}';
		$this->assertEquals($expected,$response->getContent() );
	}
}//$response->getContent()


