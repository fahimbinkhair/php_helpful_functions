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
        'liLineNumber' => '1'
    ],
    [
        'liExtrinsics' => [
            'RXDate' => '28/03/2020',
            'ItemNumber' => 'KHT0328118',
            'otherInfo' => [
                'o_1' => 'KBCD' //in upper case
            ]
        ],
        'liLineNumber' => '2'
    ],
    [
        'liExtrinsics' => [
            'RXDate' => '28/03/2019',
            'ItemNumber' => 'BHT0328118',
            'otherInfo' => [
                'o_1' => 'abcd'
            ]
        ],
        'liLineNumber' => '3'
    ]
];


print_r(multiSortAsc($array, 'liExtrinsics->otherInfo->o_1'));