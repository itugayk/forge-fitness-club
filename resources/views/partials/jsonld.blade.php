@php
    $jsonld = [
        '@context' => 'https://schema.org',
        '@type' => ['ExerciseGym', 'SportsActivityLocation', 'HealthClub'],
        'name' => config('forge.brand'),
        'description' => config('forge.description'),
        'url' => url('/'),
        'telephone' => config('forge.phone'),
        'email' => config('forge.email'),
        'priceRange' => '₺₺',
        'currenciesAccepted' => 'TRY',
        'image' => \App\Support\DemoImage::unsplash('1534438327276-14e5300c3a48', 1200, 630),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => config('forge.address'),
            'addressLocality' => config('forge.district'),
            'addressRegion' => config('forge.city'),
            'postalCode' => config('forge.postal_code'),
            'addressCountry' => config('forge.country'),
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => config('forge.latitude'),
            'longitude' => config('forge.longitude'),
        ],
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '06:00', 'closes' => '23:00',
            ],
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday', 'opens' => '08:00', 'closes' => '22:00',
            ],
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Sunday', 'opens' => '09:00', 'closes' => '20:00',
            ],
        ],
        'sameAs' => array_values(config('forge.social')),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
