<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait Timestamped
{
    /**
     * @var DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @var ?DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $updatedAt;

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param  DateTimeInterface  $createdAt
     *
     * @return Timestamped
     */
    public function setCreatedAt(DateTimeInterface $createdAt): Timestamped
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param  ?DateTimeInterface  $updatedAt
     *
     * @return Timestamped
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): Timestamped
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}