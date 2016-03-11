<?php

use Behat\Symfony2Extension\Context\KernelDictionary;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Behat\Context\SnippetAcceptingContext;
use PHPUnit_Framework_Assert as Assertions;
include 'helpers.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements \Behat\Symfony2Extension\Context\KernelAwareContext, SnippetAcceptingContext
{
    use KernelDictionary;
    /**
     * @var RestContext
     */
    private $restContext;

    private $vehicleContext;

    private $data = [];

    private $scenarioContext;

    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $DBALConnection;

    /**
     * @var \Doctrine\DBAL\Query\QueryBuilder
     */
    private $query;

    private $preRequestState;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml
     */
    public function __construct()
    {
    }

    /** @BeforeScenario */
    public function gatherContexts(\Behat\Behat\Hook\Scope\BeforeScenarioScope $scope)
    {
        $this->restContext = $scope->getEnvironment()->getContext('RestContext');

        $doctrine = $this->getContainer()->get('doctrine');
        $this->DBALConnection = $doctrine->getConnection();
    }

    /**
     * @AfterScenario
     */
    public function resetData()
    {
        unset(
            $this->data,
            $this->scenarioContext,
            $this->preRequestState
        );

    }

    /**
     * @Then the response should contain the properties:
     */
    public function theResponseShouldContainTheProperties(PyStringNode $string)
    {
        $properties = explode(',', $string);
        $properties = array_map('trim', $properties);

        $items = $this->getResponseItems();
        $items = is_array($items) ? current($items) : $items;

        foreach ($properties as $property) {
            Assertions::assertArrayHasKey($property, $items);
        }
    }

    /**
     * @Then the :context starting number should be :arg1
     * @param $arg1
     * @param $context
     */
    public function startingNumberShouldBe($arg1, $context)
    {
        $data = $this->getResponseData();

        Assertions::assertGreaterThan($arg1, $data[0]['id'] * 2);
    }

    /**
     * @Given that I want to add ":arg1"
     * @Given that I have a ":arg1"
     */
    public function thatIWantToAddOrHave($arg1)
    {
        $this->scenarioContext = $arg1;
    }

    /**
     * @param $arg1
     * @param $arg2
     * @Then the ":arg1" is ":arg2"
     */
    public function setData($arg1, $arg2)
    {
        $this->data[$arg1] = $arg2;
    }

    /**
     * @Given the following fields should be updated:
     * @param \Behat\Gherkin\Node\PyStringNode $string
     */
    public function isUpdated(PyStringNode $string)
    {
        $fields = explode(',', $string);
        $fields = array_map('trim', $fields);

        $qb = clone $this->query;
        $result = $qb->execute()->fetchAll();

        Assertions::assertCount(1, $result);

        $row = $result[0];

        foreach ($fields as $field) {
            Assertions::assertNotEquals($this->preRequestState[$field], $row[$field]);
        }
    }

    /**
     * @Given the :arg1 already exists in database
     * @param $arg1
     */
    public function itAlreadyExistsInTheDatabase($arg1)
    {
        $this->query = $this->DBALConnection->createQueryBuilder()
            ->select('*')
            ->from($this->scenarioContext, 'a')
            ->where("$arg1 = ?")
            ->setMaxResults(1)
            ->setParameter(0, $this->data[$arg1]);

        $qb = clone $this->query;
        $result = $qb->execute()->fetchAll();

        Assertions::assertCount(1, $result);

        $this->preRequestState = $result[0];
    }

    /**
     * @Given the :arg1 does not exist in database
     * @param $arg1
     */
    public function itDoesNotExistInTheDatabase($arg1)
    {
        $this->query = $this->DBALConnection->createQueryBuilder()
            ->select('*')
            ->from($this->scenarioContext, 'a')
            ->where("$arg1 = ?")
            ->setMaxResults(1)
            ->setParameter(0, $this->data[$arg1]);

        $qb = clone $this->query;
        $result = $qb->execute()->fetchAll();

        Assertions::assertCount(0, $result);
    }

    /**
     * @return mixed
     */
    public function getResponseData()
    {
        return json_decode($this->restContext->getResponse()->getBody(), true);
    }

    public function getResponseItems()
    {
        $data = $this->getResponseData();

        $items = $data['data']['items'];

        return $items;
    }

    /**
     * @Given that I want to find :arg1
     */
    public function thatIWantToFind($arg1)
    {
        $this->scenarioContext = $arg1;
        Assertions::assertTrue(strlen($arg1) > 0);
    }    

    /**
     * @Then the data has :arg1 results
     */
    public function theDataHasResults($arg1)
    {
        Assertions::assertCount(intval($arg1), $this->getResponseItems());
    }

    /**
     * @Then the data only contains the :arg1 of :arg2
     */
    public function theDataOnlyContainsTheOf($arg1, $arg2)
    {
        $data = $this->getResponseItems();

        foreach ($data as $row) {

            if(is_int($arg2)) {
                $arg2 = intval($arg2);
            }

            Assertions::assertEquals($arg2, array_get($row,$arg1));
        }
    }

    /**
     * @Then the response is a collection of :context with all their properties:
     */
    public function assertCollectionProperties(PyStringNode $string, $context)
    {
        $properties = explode(',', $string);
        $properties = array_map('trim', $properties);

        $data = $this->getResponseItems();

        foreach ($data as $entity) {

            foreach ($properties as $property) {
                Assertions::assertArrayHasKey($property, $entity);
            }
        }
    }

    /**
     * Sends HTTP request to specific relative URL.
     *
     * @param string $method request method
     * @param string $url    relative url
     *
     * @When I send a GET request to :url of :manufacturerName with limit :limit offset :offset
     */
    public function iSendAGetRequestWithLimitOffset($url, $manufacturerName, $offset, $limit)
    {
        $this->restContext->iSendARequest('GET', $url);
    }

    /**
     * @Then the page index should be :arg1
     */
    public function thePageIndexShouldBe($arg1)
    {
        $data = $this->getResponseData();

        Assertions::assertEquals($arg1, $data['data']['page_index']);
    }
}
