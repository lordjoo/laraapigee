<?php

namespace Lordjoo\Apigee\Abstract;

interface ApigeeApiInterface
{

    public function product();

    public function proxy();

    public function developer();

    public function developerApp(string $developerId);
}
