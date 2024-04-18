<?php

return [
    'breeds' => [
        'whippet',
        'cockapoo',
        'labrador',
        'dalmatian',
        'pug',
        'frenchie'
    ],
    'allergies' => [
        'fish',
        'duck',
        'chicken',
        'beef',
        'turkey'
    ],
    'recipes' => [
        [
            'name'                => 'Duck Delight',
            'puppy_inappropriate' => false,
            'breed_inappropriate' => 'dalmatian',
            'allergen'            => 'duck'
        ],
        [
            'name'                => 'Chicken Dinner',
            'puppy_inappropriate' => false,
            'breed_inappropriate' => 'dalmatian',
            'allergen'            => 'chicken'
        ],
        [
            'name'                => 'Brilliant Beef',
            'puppy_inappropriate' => false,
            'breed_inappropriate' => 'dalmatian',
            'allergen'            => 'beef'
        ],
        [
            'name'                => 'Fish Supper',
            'puppy_inappropriate' => true,
            'breed_inappropriate' => '',
            'allergen'            => 'fish'
        ],
        [
            'name'                => 'Turkey Terrific',
            'puppy_inappropriate' => true,
            'breed_inappropriate' => 'dalmatian',
            'allergens'           => 'turkey'
        ],
    ]
];