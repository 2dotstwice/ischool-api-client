<?php

namespace TwoDotsTwice\ISchoolApiClient;

use TwoDotsTwice\ISchoolApiClient\Model\Info;

interface ApiClient
{
    const BASE_URL = 'https://www.i-school.be/';

    public function getActivities(): array;

    public function getInfo(): Info;
}
