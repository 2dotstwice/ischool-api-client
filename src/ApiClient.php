<?php

namespace TwoDotsTwice\ISchoolApiClient;

interface ApiClient
{
    const BASE_URL = 'https://www.i-school.be/';

    public function getActivities(): array;
}
