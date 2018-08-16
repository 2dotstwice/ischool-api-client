<?php

namespace TwoDotsTwice\ISchoolApiClient\Model;

class Info
{
    /**
     * @var string
     */
    private $calendarLink;

    /**
     * @var string
     */
    private $profileLink;

    /**
     * @return string
     */
    public function getCalendarLink(): string
    {
        return $this->calendarLink;
    }

    /**
     * @param string $calendarLink
     */
    public function setCalendarLink(string $calendarLink): void
    {
        $this->calendarLink = $calendarLink;
    }

    /**
     * @return string
     */
    public function getProfileLink(): string
    {
        return $this->profileLink;
    }

    /**
     * @param string $profileLink
     */
    public function setProfileLink(string $profileLink): void
    {
        $this->profileLink = $profileLink;
    }
}
