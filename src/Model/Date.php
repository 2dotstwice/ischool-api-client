<?php

namespace TwoDotsTwice\ISchoolApiClient\Model;

use DateTime;
use DateTimeInterface;
use DateTimeZone;

class Date
{
    private $year;
    private $month;
    private $day;

    /**
     * Date constructor.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function __construct(int $year, int $month, int $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    /**
     * @param \DateTimeZone $timeZone
     * @return \DateTimeInterface
     */
    public function toDateTime(DateTimeZone $timeZone): DateTimeInterface
    {
        $dateTime = new DateTime('now', $timeZone);
        $dateTime->setDate($this->year, $this->month, $this->day);

        return $dateTime;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getDay(): int
    {
        return $this->day;
    }
}
