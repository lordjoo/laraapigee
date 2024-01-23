<?php

namespace Lordjoo\Apigee\Entities\Monetization;

use Carbon\Carbon;
use Lordjoo\Apigee\Api\Edge\Monetization\Monetization;
use Lordjoo\Apigee\Apigee;

abstract class Entity
{
    protected Monetization $client;

    public function __construct(array $data)
    {
        $this->client = app(Apigee::class)->monetization();
        $this->setAttributes($data);
    }

    protected function setAttributes(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if ($key === 'attributes') {
                    $this->attributes = [];
                    foreach ($value as $attribute) {
                        $this->attributes[] = new \Lordjoo\Apigee\Entities\Attribute($attribute);
                    }

                    continue;
                }
                if (is_numeric($value) && $value > 1000000000) {
                    $value = Carbon::createFromTimestamp($value / 1000);
                }

                $rp = new \ReflectionProperty($this, $key);
                $type = $rp->getType()->getName();
                if (class_exists($type)) {
                    $value = new $type($value);
                }

                $this->{$key} = $value;
            }
        }
    }
}
