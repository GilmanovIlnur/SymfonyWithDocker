<?php


namespace App\Dto;


use Symfony\Component\HttpFoundation\Request;

interface DtoInterface
{
    public function __construct(Request $request);
}