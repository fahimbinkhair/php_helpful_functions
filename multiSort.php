<?php
/**
 * @param array $array
 * @param string $keys
 * @return array
 */
function multiSortAsc(array $array, string $keys): array
{
    /** @var array $keys */
    $keys = explode('->', $keys);

    array_multisort(array_map(function ($element) use ($keys) {
        foreach ($keys as $key) {
            if (array_key_exists($key, $element)) {
                $element = $element[$key];
            } else {
                Logger::init(LOG_ERR)
                    ->setLogRaisedBy(__FILE__, __LINE__)
                    ->setMessage("Can not find the key '{$key}'")
                    ->throwException();
            }
        }

        return $element;
    }, $array), SORT_ASC, SORT_NATURAL|SORT_FLAG_CASE, $array);

    return $array;
}

$array = [
    [
        'liExtrinsics' => [
            'RXDate' => '28/03/2021',
            'ItemNumber' => 'XHT0328118',
            'otherInfo' => [
                'o_1' => 'cbcd'
            ]
        ],
        'liLineNumber' => '1',
        'liDescriptions' => [
            'Description' => 'One Monthly delivery charge'
        ],
        'liCost_lineCostNet' => '45',
        'liCost_lineVATCode' => 'Z'
    ],
    [
        'liExtrinsics' => [
            'RXDate' => '28/03/2020',
            'ItemNumber' => 'KHT0328118',
            'otherInfo' => [
                'o_1' => 'KBCD' //in upper case
            ]
        ],
        'liLineNumber' => '2',
        'liDescriptions' => [
            'Description' => 'Prednisolone 2.5mg Tab[28]'
        ],
        'liCost_lineCostNet' => '0.6',
        'liCost_lineVATCode' => 'Z'
    ],
    [
        'liExtrinsics' => [
            'RXDate' => '28/03/2019',
            'ItemNumber' => 'BHT0328118',
            'otherInfo' => [
                'o_1' => 'abcd'
            ]
        ],
        'liLineNumber' => '3',
        'liDescriptions' => [
            'Description' => 'Modigraf 0.2mg Oral Susp [50]'
        ],
        'liCost_lineCostNet' => '191.65',
        'liCost_lineVATCode' => 'Z'
    ]
];


print_r(multiSortAsc($array, 'liExtrinsics->otherInfo->o_1'));