<?php

declare(strict_types=1);


namespace App\Entity;

/**
 * Role Entity Class
 */
class Role
{
    private $id;
    private $name;
    private $descriptions;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions= $descriptions;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
