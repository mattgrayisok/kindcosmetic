<?php
/**
 * User: Slice
 * Date: 18/08/15
 * Time: 20:47
 */

class ExtendedTest extends \Codeception\TestCase\Test{

    protected $events = [];

    protected function _before()
    {
    }

    protected function _after()
    {

        if ($this->events) {
            throw new Exception(
                'The following events were not fired: ['.implode(', ', $this->events).']'
            );
        }

    }

    public function expectsEvents($events)
    {
        $this->events = is_array($events) ? $events : func_get_args();

        $mock = Mockery::spy('Illuminate\Contracts\Events\Dispatcher');

        $mock->shouldReceive('fire')->andReturnUsing(function ($called) {
            foreach ($this->events as $key => $event) {
                if ((is_string($called) && $called === $event) ||
                    (is_string($called) && is_subclass_of($called, $event)) ||
                    (is_object($called) && $called instanceof $event)) {
                    unset($this->events[$key]);
                }
            }
        });

        App::instance('events', $mock);

        return $this;
    }

    protected function withoutEvents()
    {
        $mock = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');

        $mock->shouldReceive('fire');

        App::instance('events', $mock);

        return $this;
    }

}