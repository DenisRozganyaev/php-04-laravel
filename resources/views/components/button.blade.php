@props([
    'type' => 'a',
    'colorType' => 'primary',
    'action' => ''
])

@php
    $typeClassesDict = [
        'primary' => 'border-indigo-500 bg-indigo-500 hover:bg-indigo-600 text-white',
        'success' => 'border-green-500 bg-green-500 hover:bg-green-600 text-white',
        'warning' => 'border-yellow-500 bg-yellow-500 hover:bg-yellow-600 text-white',
        'danger' => 'border-red-500 bg-red-500 hover:bg-red-600 text-white',
        'info' => 'border-teal-500 bg-teal-500 hover:bg-teal-600 text-white',
    ];

    $defaultClasses = 'ease focus:shadow-outline m-2 select-none rounded-md border px-4 py-2 transition duration-500 focus:outline-none';
    $typeClasses = $typeClassesDict[$colorType];

    $actionType = $action ? "type={$action}" : '';
@endphp

<{{$type}} {{$actionType}} {{ $attributes->merge(['class' => $defaultClasses . ' ' . $typeClasses]) }}>
    {{ $slot }}
</{{$type}}>
