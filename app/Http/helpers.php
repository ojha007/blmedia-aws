<?php

function spanByStatus($status, $withPull = '')
{
    switch (strtolower($status)) {
        case 'yes':
        case '1':
            $labelClass = 'label-success';
            $labelName = 'Active';
            break;
        case 'no';
        case '0':
            $labelClass = 'label-warning';
            $labelName = 'Inactive';
            break;
        case 'draft':
            $labelClass = 'label-info';
            $labelName = 'Draft';
            break;
        default:
            $labelClass = 'label-warning';
            $labelName = 'Pending';

    }
    return '<span   style="cursor: default;"
        class="label btn btn-flat  ' . $labelClass . ' ' . ($withPull) . '">'
        . ucfirst($labelName) . '</span>';
}

function camelCaseToUcWord($string)
{
    $string = str_replace('.', '_', $string);
    $string = preg_replace('/(?<=\\w)(?=[A-Z])/', "_$1", $string);
    $string = ucwords(str_replace('_', ' ', $string));
    return $string;
}

function getBaseRouteByUrl($request): string
{
    $routeSting = $request->route()->getAction('as');
    $toArray = explode('.', $routeSting);
    $a = array_slice($toArray, 0, -1);
    return implode('.', $a);

}

function getNumberInWords()
{

    return [
        '1' => 'first',
        '2' => 'second',
        '3' => 'third',
        '4' => 'fourth',
        '5' => 'fifth',
        '6' => 'sixth',
        '7' => 'seventh',
        '8' => 'eighth',
        '9' => 'ninth',
        '10' => 'tenth',
        '11' => 'eleventh',
        '12' => 'twelve',
        '13' => 'thirteen',
        '14' => 'fourteen',
    ];
}


