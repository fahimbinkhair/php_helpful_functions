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
    }, $array), SORT_ASC, $array);

    return $array;
}

$array = [
    [
        'liExtrinsics' => [
            'RXDate' => '28/03/2021'
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
            'RXDate' => '28/03/2020'
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
            'RXDate' => '28/03/2019'
        ],
        'liLineNumber' => '4',
        'liDescriptions' => [
            'Description' => 'Modigraf 0.2mg Oral Susp [50]'
        ],
        'liCost_lineCostNet' => '191.65',
        'liCost_lineVATCode' => 'Z'
    ],
    [
        'liExtrinsics' => [
            'RXDate' => '28/03/2019'
        ],
        'liLineNumber' => '5',
        'liDescriptions' => [
            'Description' => 'Cellcept 1g/5ml 175ml <1>'
        ],
        'liCost_lineCostNet' => '115.16',
        'liCost_lineVATCode' => 'Z'
    ]
];


print_r(multiSortAsc($array, 'liExtrinsics->RXDate'));