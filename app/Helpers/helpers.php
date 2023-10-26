<?php

use Illuminate\Support\Str;

function money_format($number, $symbol = "Rp. ")
{
    return $number > 0
        ? $symbol . number_format($number, 0, ',', '.')
        : "(" . $symbol . number_format(-1 * $number, 0, ',', '.') . ")";
}

function sign_number($debit, $credit)
{
    return $debit > 0 ? $debit : (-1 * $credit);
}

function text_sign($mutation, $debit_text = 'debit', $credit_text = 'credit')
{
    return $mutation > 0 ? $debit_text : $credit_text;
}

function old_if($condition = true, $key = null, $default = null)
{
    return $condition ? old($key, $default) : $default;
}

function invalid_is($name)
{
    return request('invalid') == $name;
}

function old_modal_is($name)
{
    return old('_modal') == $name;
}

function active($condition)
{
    return $condition ? 'active' : '';
}

function active_if_path($path)
{
    return active(request()->is($path . "*"));
}

function active_if_request($query, $value, $is_default = false)
{
    if (!request($query) && $is_default) return active(true);

    return active(request($query) == $value);
}

function calculate_growth($current, $last)
{
    if ($last == 0) {
        return $current == 0 ? 0 : 100;
    }
    else {
        return 100 * ($current - $last) / $last;
    }
}

function generateMonthNames(string $locale = 'id')
{
    $month_numbers = range(1, 12);
    $month_names = array_map(fn($month) => now()->subMonth(date('m') - $month)->translatedFormat('F'), $month_numbers);

    return array_combine($month_numbers, $month_names);
}

function array_filter_key($array, $keys) {
    return array_filter($array, fn($key) => in_array($key, $keys), ARRAY_FILTER_USE_KEY);
}

function array_except_key($array, $keys) {
    return array_filter($array, fn($key) => ! in_array($key, $keys), ARRAY_FILTER_USE_KEY);
}

function all_method_exists($object, $methods)
{
    $method_exists_in_object = fn($method) => method_exists($object, $method);

    return (bool) array_product(
        array_map($method_exists_in_object, $methods)
    );
}

function studly($input)
{
    return Str::studly($input);
}

function get_entity_name($object, string $search)
{
    $search = [
        __NAMESPACE__,
        '\\',
        $search
    ];

    return str_replace($search, '', get_class($object));
}