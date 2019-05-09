<?php

namespace TwoDotsTwice\ISchoolApiClient\Model;

class GetActivitiesParameters
{
    /**
     * @var \DateTimeInterface|null
     */
    private $endDate;

    public function withEndDate(\DateTimeInterface $endDate): self
    {
        $c = clone $this;
        $c->endDate = $endDate;
        return $c;
    }

    public function toArray(): array
    {
        $parameters = [];

        if ($this->endDate instanceof \DateTimeInterface) {
            $parameters['penddat'] = $this->endDate->format('Ymd');
        }

        return $parameters;
    }
}
