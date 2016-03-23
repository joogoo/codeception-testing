<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/');
$I->fillField('username','davert');
$I->fillField('password','qwerty');
$I->click('Sign in !');
$I->seeInCurrentUrl('/signin');
$I->see('Hello, davert !');
