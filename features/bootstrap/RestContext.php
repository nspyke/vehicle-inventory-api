<?php

use PHPUnit_Framework_Assert as Assertions;

class RestContext extends \Behat\WebApiExtension\Context\WebApiContext
{
    /**
     * @param $arg1
     * @param $arg2
     * @Then the response header :arg1 equals ":arg2"
     */
    public function theResponseHeaderEquals($arg1, $arg2)
    {
        Assertions::assertTrue(
            $this->getResponse()->hasHeader($arg1),
            "The response header '$arg1' does not exist"
        );

        if ($this->getResponse()->hasHeader($arg1)) {
            Assertions::assertEquals(
                $arg2,
                $this->getResponse()->getHeaderLine($arg1),
                "The response header '$arg1' does not equal $arg2"
            );
        }
    }

    /**
     * @param $arg1
     * @param $arg2
     * @Then the response header :arg1 contains ":arg2"
     */
    public function theResponseHeaderContains($arg1, $arg2)
    {
        Assertions::assertTrue(
            $this->getResponse()->hasHeader($arg1),
            "The response header '$arg1' does not exist"
        );

        if ($this->getResponse()->hasHeader($arg1)) {
            Assertions::assertContains(
                $arg2,
                $this->getResponse()->getHeaderLine($arg1),
                "The response header '$arg1' does not contain $arg2",
                true
            );
        }
    }

    /**
     * @param $arg1
     * @param $arg2
     * @Then the response header :arg1 matches ":arg2"
     */
    public function theResponseHeaderMatches($arg1, $arg2)
    {
        Assertions::assertTrue(
            $this->getResponse()->hasHeader($arg1),
            "The response header '$arg1' does not exist"
        );

        if ($this->getResponse()->hasHeader($arg1)) {
            Assertions::assertRegExp(
                '/'.$arg2.'/i',
                $this->getResponse()->getHeaderLine($arg1),
                "The response header '$arg1' does not match $arg2",
                true
            );
        }
    }

    /**
     * @Then the response is empty
     */
    public function theResponseIsEmpty()
    {
        $body = (string) $this->getResponse()->getBody();
        Assertions::assertEmpty($body);
    }

}