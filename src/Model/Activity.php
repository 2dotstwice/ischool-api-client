<?php

namespace TwoDotsTwice\ISchoolApiClient\Model;

use DateTimeInterface;

class Activity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var Date
     */
    private $beginDate;

    /**
     * @var Date
     */
    private $endDate;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $price;

    /**
     * @var \DateTimeInterface
     */
    private $reservationBeginDateTime;

    /**
     * @var \DateTimeInterface
     */
    private $reservationEndDateTime;

    /**
     * @var int
     */
    private $currentReservations;

    /**
     * @var int
     */
    private $maxReservations;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $location;

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return Date
     */
    public function getBeginDate(): Date
    {
        return $this->beginDate;
    }

    /**
     * @param Date $beginDate
     */
    public function setBeginDate(Date $beginDate): void
    {
        $this->beginDate = $beginDate;
    }

    /**
     * @return Date|null
     */
    public function getEndDate(): ?Date
    {
        return $this->endDate;
    }

    /**
     * @param Date|null $endDate
     */
    public function setEndDate(Date $endDate = null): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReservationBeginDateTime(): DateTimeInterface
    {
        return $this->reservationBeginDateTime;
    }

    /**
     * @param \DateTimeInterface $reservationBeginDateTime
     */
    public function setReservationBeginDateTime(
        DateTimeInterface $reservationBeginDateTime
    ): void {
        $this->reservationBeginDateTime = $reservationBeginDateTime;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReservationEndDateTime(): DateTimeInterface
    {
        return $this->reservationEndDateTime;
    }

    /**
     * @param \DateTimeInterface $reservationEndDateTime
     */
    public function setReservationEndDateTime(
        DateTimeInterface $reservationEndDateTime
    ): void {
        $this->reservationEndDateTime = $reservationEndDateTime;
    }

    /**
     * @return int
     */
    public function getCurrentReservations(): int
    {
        return $this->currentReservations;
    }

    /**
     * @param int $currentReservations
     */
    public function setCurrentReservations(int $currentReservations = null): void
    {
        $this->currentReservations = $currentReservations;
    }

    /**
     * @return int
     */
    public function getMaxReservations(): ?int
    {
        return $this->maxReservations;
    }

    /**
     * @param int $maxReservations
     */
    public function setMaxReservations(int $maxReservations = null): void
    {
        $this->maxReservations = $maxReservations;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }
}
