@php
     $classes = 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm form-control';
    if ($errors->has($attributes->get('wire:model'))) {
        $classes .= ' is-invalid';
    }
@endphp
<select {!! $attributes->merge(['class' => $classes]) !!}>
    {{$slot}}
 </select>