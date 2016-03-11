<?php


namespace ApiBundle\Handler;


class HandlerResponse 
{
    /**
     * @var bool
     */
    private $created = false;

    /**
     * @var bool
     */
    private $updated = false;

    /**
     * @var bool
     */
    private $read = false;

    /**
     * @var object
     */
    public $entity;

    public function creating()
    {
        $this->created = true;
        $this->updated = false;
    }

    public function updating()
    {
        $this->updated = true;
        $this->created = false;
    }

    public function reading()
    {
        $this->read = true;
    }

    public function isCreate()
    {
        return $this->created;
    }

    public function isUpdate()
    {
        return $this->updated;
    }

    public function isRead()
    {
        return $this->read;
    }
}