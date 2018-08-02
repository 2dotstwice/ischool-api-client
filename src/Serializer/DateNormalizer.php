<?php

namespace TwoDotsTwice\ISchoolApiClient\Serializer;

use DateTime;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use TwoDotsTwice\ISchoolApiClient\Model\Date;

class DateNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === Date::class;
    }

    public function denormalize(
        $data,
        $class,
        $format = null,
        array $context = array()
    ) {
        $date = DateTime::createFromFormat('Y-m-d', $data);

        return new Date(
            (int)$date->format('Y'),
            (int)$date->format('m'),
            (int)$date->format('d')
        );
    }
}
