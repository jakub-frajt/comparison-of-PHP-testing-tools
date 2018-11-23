<?php use App\Tests\Codeception\AcceptanceTester;

class RegistrationProcessCest {

    public function registrationProcessSuccess(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Registration', 'h1');
        $I->fillField('firstname', 'Jan');
        $I->fillField('lastname', 'Novák');
        $I->fillField('email', 'novak@example.com');
        $I->click('Submit');
        $I->see('Registration successfully completed.');
    }

    public function registrationWithEmptyForm(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Registration', 'h1');
        $I->click('Submit');
        $I->see('E-mail cannot be empty.');
        $I->see('First name cannot be empty.');
        $I->see('Last name cannot be empty.');
    }

    public function registrationWithInvalidEmail(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Registration', 'h1');
        $I->fillField('firstname', 'Jan');
        $I->fillField('lastname', 'Novák');
        $I->fillField('email', 'novak.com');
        $I->click('Submit');
        $I->see('E-mail is not valid.');
    }

}
