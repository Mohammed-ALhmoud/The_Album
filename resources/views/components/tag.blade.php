@props(['tag', 'size' => 'base'])

@php
    $classes = "bg-[#ffffff]/10 hover:bg-[#f9b17a] hover:text-[#2d3250] px-3 py-1 rounded-xl text-[10px] font-bold transition-colors duration-300";

    if ($size === 'base'){
        $classes .= " px-5 py-1 text-sm";

    }
@endphp

@php
    if ($size === 'small'){
        $classes .= " px-3 py-1 text-[10px]";
    }
@endphp

<a href="/tags/{{ strtolower($tag->name) }}" class="{{ $classes }}">{{ $tag->name }}</a>
