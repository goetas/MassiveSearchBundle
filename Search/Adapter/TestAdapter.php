<?php

namespace Massive\Bundle\SearchBundle\Search\Adapter;

use Massive\Bundle\SearchBundle\Search\Document;
use Massive\Bundle\SearchBundle\Search\AdapterInterface;
use Sulu\Bundle\SearchBundle\Search\Factory;

/**
 * Test adapter for testing scenarios
 *
 * @author Daniel Leech <daniel@massive.com>
 */
class TestAdapter implements AdapterInterface
{
    protected $documents = array();
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritDoc}
     */
    public function index(Document $document, $indexName)
    {
        $this->documents[] = $document;
    }

    /**
     * {@inheritDoc}
     */
    public function search($queryString, array $indexNames = array())
    {
        $hits = array();

        foreach ($this->documents as $document) {
            $hit = $this->factory->makeQueryHit();
            $hit->setDocument($document);
            $hit->setScore(-1);
            $hits[] = $hit;
        }

        return $hits;
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {
        return array();
    }
}
