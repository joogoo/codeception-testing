<?php

namespace Acceptance;

use AcceptanceTester;

class SigninCest
{
    public function _before(AcceptanceTester $I)
    {
        $this->users = include (__DIR__ . '/../../users.php');
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function signinWithExistingUser(AcceptanceTester $I)
    {
        $I->wantTo('log in as regular user');
        $I->amOnPage('/');
        $I->fillField('username', 'davert');
        $I->fillField('password', $this->users['davert']);
        $I->click('Sign in !');
        $I->seeInCurrentUrl('/signin');
        
        $I->see('Hello, davert !');
    }

    /**
     * @depends signinWithExistingUser
     */
    public function signinAndSignout(AcceptanceTester $I)
    {
        $I->wantTo('log in as regular user and log out');
        $I->amOnPage('/');
        $I->fillField('username', 'davert');
        $I->fillField('password', $this->users['davert']);
        $I->click('Sign in !');
        $I->seeInCurrentUrl('/signin');
        $I->see('Hello, davert !');
        $I->click('Signout');
        
        $I->see('Sign in !');
    }
    
    public function signinWithNonExistentUser(\AcceptanceTester $I)
    {
        $I->wantTo('log in as an unexistent user');
        $I->amOnPage('/');
        $time = time();
        $I->fillField('username', "davert" . $time);
        $I->fillField('password', $this->users['davert'] . $time);
        $I->click('Sign in !');
        $I->seeInCurrentUrl('/signin');
        
        $I->see(sprintf('Username %s%s does not exist.', 'davert', $time));
    }
}
