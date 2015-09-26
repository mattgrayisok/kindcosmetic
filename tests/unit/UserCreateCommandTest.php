<?php


class UserCreateCommandTest extends ExtendedTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {

        parent::_before();

    }

    protected function _after()
    {

        parent::_after();

    }

    // tests
    public function testUserCreateCommand_userCanBeCreated()
    {

        $adapter = app('App\Adapters\MockAdapter');
        $adapter->setAuthState(null, null, false);

        $this->expectsEvents([\App\Events\UserCreatedEvent::class]);

        $command = new \App\Commands\Users\UserCreateCommand('slice-beans', 'matt.gray@retrofuzz.com', 'password');
        $adapter->dispatchCommand($command);

        $users = \App\Models\User::where('username', '=', 'slice-beans')->where('email', '=', 'matt.gray@retrofuzz.com')->get();
        $this->assertEquals(1, $users->count());
    }

    public function testUserCreateCommand_exceptionThrownWhenUsernameTooShort()
    {

        $adapter = app('App\Adapters\MockAdapter');
        $adapter->setAuthState(null, null, false);

        \PHPUnit_Framework_TestCase::setExpectedException('App\Exceptions\ValidationException');

        $command = new \App\Commands\Users\UserCreateCommand('', 'matt.gray@retrofuzz.com', 'password');
        $adapter->dispatchCommand($command);

    }

    public function testUserCreateCommand_exceptionThrownWhenEmailTooShort()
    {

        $adapter = app('App\Adapters\MockAdapter');
        $adapter->setAuthState(null, null, false);

        \PHPUnit_Framework_TestCase::setExpectedException('App\Exceptions\ValidationException');

        $command = new \App\Commands\Users\UserCreateCommand('slice-beans', '', 'password');
        $adapter->dispatchCommand($command);

    }

    public function testUserCreateCommand_userCannotBeCreatedByLoggedInUser()
    {

        $adapter = app('App\Adapters\MockAdapter');
        $adapter->setAuthState(1, 1, false);

        \PHPUnit_Framework_TestCase::setExpectedException('App\Exceptions\AuthenticationException');

        $command = new \App\Commands\Users\UserCreateCommand('slice-beans', '', 'password');
        $adapter->dispatchCommand($command);

    }


}