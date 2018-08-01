<?php

namespace TwoDotsTwice\ISchoolApiClient\Serializer;

use DateTimeZone;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerFactory
{
    public function createSerializer(): Serializer
    {
        $nameConverter = new AddPrefixNameConverter(
            'item_',
            new CamelCaseToSnakeCaseNameConverter(null, true)
        );

        $objectNormalizer = new ObjectNormalizer(null, $nameConverter, null, new ReflectionExtractor());

        $normalizers = [
            new DateNormalizer(),
            new DateTimeNormalizer('Y-m-d\TH:i:s', new DateTimeZone('Europe/Brussels')),
            $objectNormalizer,
            new ArrayDenormalizer(),
        ];

        $encoders = [
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers, $encoders);

        return $serializer;
    }
}
