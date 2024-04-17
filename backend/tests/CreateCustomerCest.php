<?php

class CreateCustomerCest
{
    public function _before(ApiTester $I)
    {
    }

    // get
    public function get(ApiTester $I)
    {
		$I->sendGet('http://localhost/application-test/backend/');
		$I->seeResponseCodeIsSuccessful();
		$I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();		
    }
	
	// findById
    public function findById(ApiTester $I)
    {
		$I->sendGet('http://localhost/application-test/backend/?id=1');
		$I->seeResponseCodeIsSuccessful();
		$I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();		
    }
	
	// post
    public function post(ApiTester $I)
    {
		$I->haveHttpHeader('accept', 'application/json');
		$I->haveHttpHeader('content-type', 'application/json');
		$I->sendPostAsJson('http://localhost/application-test/backend/', [
			"id" => "5",
			"name" => "Test Test",
			"state" => "NY",
			"zip" => "08998",
			"amount" => "30.55",
			"qty" => "15",
			"item" => "BVG96520"
		]);
		$I->seeResponseCodeIsSuccessful();
		$I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
	
	// put
    public function put(ApiTester $I)
    {
		$I->haveHttpHeader('accept', 'application/json');
		$I->haveHttpHeader('content-type', 'application/json');
		$I->sendPutAsJson('http://localhost/application-test/backend/', [
			"id" => "4",
			"name" => "Scheckled Sherlock",
			"state" => "WA",
			"zip" => "88990",
			"amount" => "987.56",
			"qty" => "10",
			"item" => "TR909"
		]);
		$I->seeResponseCodeIsSuccessful();
		$I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
	
	// put
    public function delete(ApiTester $I)
    {
		$I->haveHttpHeader('accept', 'application/json');
		$I->haveHttpHeader('content-type', 'application/json');
		$I->sendDeleteAsJson('http://localhost/application-test/backend/?id=1');
		$I->seeResponseCodeIsSuccessful();
		$I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}
