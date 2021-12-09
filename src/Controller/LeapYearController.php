<?php

namespace App\Controller;

use App\Model\LeapYear;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    public function index(Request $request, $year)
    {
        $leapYear = new LeapYear();
        if ($leapYear->isLeapYear($year)) {
            $response = new Response('Yep, this is a leap year!');
        } else {
            $response = new Response('Nope, this is not a leap year.');
        }

        $response = new Response('Yep, this is a leap year! ' . rand() . " ");

        if ($response->isNotModified($request)) {
            return $response;
        }

        $response->setPublic();
        $response->setMaxAge(10);
        $response->setSharedMaxAge(10);
        $response->setImmutable();
        $response->setLastModified(new \DateTime());
        $response->setETag('whatever_you_compute_as_an_etag');

        return $response;
    }
}