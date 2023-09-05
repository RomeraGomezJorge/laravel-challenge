@php
    function generateSortUrl($column) {
        $direction = (Request::has('direction') && Request::get('direction') == 'ASC') ? 'DESC' : 'ASC';
        $queryParams = array_merge(Request::except(['order_by', 'direction']), ['order_by' => $column, 'direction' => $direction]);
        return route('discount.index') . '?' . http_build_query($queryParams);
    }
    function generateSorDirectionIcon() {
        return (Request::get('direction') == 'ASC')
                ? '<svg class="h-2 w-2 text-gray-500 inline-block"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M5.07 19H19a2 2 0 0 0 1.75 -2.75L13.75 4a2 2 0 0 0 -3.5 0L3.25 16.25a2 2 0 0 0 1.75 2.75" /></svg>'
                : '<svg class="h-2 w-2 text-gray-500 inline-block"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="transform: rotate(180deg);">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M5.07 19H19a2 2 0 0 0 1.75 -2.75L13.75 4a2 2 0 0 0 -3.5 0L3.25 16.25a2 2 0 0 0 1.75 2.75" /></svg>';
    }
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-gray-800 leading-tight">
            <div class="p-6 bg-white border-gray-200 flex">
                <div class="w-2/3">
                    <div class="text-xl text-gray-800 font-bold pb-2">
                        {{ __('discount.discounts_heading') }}
                    </div>
                    <div class="text-sm text-blue-500">
                        {{ __('discount.discounts_description') }}
                    </div>
                </div>
                <div class="w-1/3">
                    <div class="flex gap-2 w-fit ml-auto">
                        <a href="{{ route('discount.create') }}">
                            <div class="font-bold p-2 rounded bg-sky-800 text-neutral-200 w-fit self-center">
                                {{ __('discount.new_discount') }}
                            </div>
                        </a>
                        <div
                            class="font-bold p-2 rounded bg-neutral-200 text-neutral-400 w-fit self-center cursor-not-allowed"
                        >
                            {{ __('discount.export') }}...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @if(session()->has('message'))
        <div class="max-w-6xl mx-auto py-2 px-6 mt-2 border rounded bg-cyan-600 text-neutral-100">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-4 mb-8">
                    <form method="GET">
                        <div class="px-6 py-2 flex items-center gap-2">
                            <div class="flex flex-col w-1/6">
                                <div class="font-bold ml-2">
                                    {{ __('discount.brand') }}
                                </div>
                                <div>
                                    <select class="rounded border-gray-300 w-full" name="brand_id">
                                        <option disabled selected>{{ __('main.select') }}...</option>
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{ $brand->id }}"
                                                {{ (Request::get('brand_id') == $brand->id) ? 'selected' : '' }}
                                            >
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col w-1/6">
                                <div class="font-bold ml-2">
                                    {{ __('discount.access_type') }}
                                </div>
                                <div>
                                    <select
                                        class="rounded border-gray-300 w-full"
                                        name="region"
                                    >
                                        <option disabled selected
                                        >
                                            {{ __('main.select') }}...
                                        </option>
                                        @foreach($regions as $region)
                                            <option
                                                value="{{ $region->id }}"
                                                {{ (Request::get('region') == $region->id) ? 'selected' : '' }}
                                            >
                                                {{ $region->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col w-1/6">
                                <div class="font-bold ml-2">
                                    {{ __('discount.rule_name_label') }}
                                </div>
                                <div>
                                    <input
                                        name="discount_name"
                                        id="discount_name"
                                        type="text"
                                        class="w-full border border-gray-300 rounded rounded-md text-neutral-700"
                                        placeholder="{{ __('discount.placeholder_name') }}"
                                        value="{{ Request::get('discount_name') }}"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-col w-1/6">
                                <div class="font-bold ml-2">
                                    {{ __('discount.awd_bcd') }}
                                </div>
                                <div>
                                    <input
                                        name="awd_bcd_code"
                                        id="awd_bcd_code"
                                        type="text"
                                        class="w-full border border-gray-300 rounded rounded-md text-neutral-700"
                                        placeholder="{{ __('discount.code') }}..."
                                        value="{{ Request::get('awd_bcd_code') }}"/>
                                </div>
                            </div>
                            <div class="flex flex-col w-2/6">
                                <div class="flex justify-end align-middle gap-2">
                                    <input
                                        class="p-2 px-4 bg-sky-900 text-neutral-100 rounded"
                                        type="submit"
                                        value="{{ __('discount.search_filter') }}"
                                    />
                                    <a href="{{ route('discount.index') }}">
                                        <div
                                            class="cursor-pointer p-2 px-4 bg-neutral-200 text-neutral-700 border border-neutral-400 rounded">
                                            {{ __('discount.reset_filter') }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-10 text-sm">
                <div class="my-8 mx-4">
                    <table class="w-full text-center text-xs ">
                        <thead >

                        <tr>
                            <th class="w-24">
                                <a href="{{generateSortUrl('brand_name')}}">
                                    {{ __('discount.brand') }} {!! generateSorDirectionIcon() !!}
                                </a>

                            </th>
                            <th class="w-20">
                                <a href="{{generateSortUrl('region_code')}}">
                                    {{ __('discount.region') }} {!! generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th class="w-32">
                                <a href="{{generateSortUrl('name')}}">
                                    {{ __('discount.rule_name_label') }} {!! generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th class="w-24">
                                <a href="{{generateSortUrl('access_type_name')}}">
                                    {{ __('discount.access_type') }} {!! generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{generateSortUrl('active')}}">
                                    {{ __('discount.active') }} {!! generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th class="w-24">
                                {{ __('discount.period') }}
                            </th>
                            <th>
                                {{ __('discount.awd_bcd') }}
                            </th>
                            <th>
                                {{ __('discount.gsa_discount') }}
                            </th>
                            <th class="w-50" >
                                <a href="{{generateSortUrl('start_date')}}">
                                    {{ __('discount.promotion_period') }} {!! generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th class="w-24">
                                <a href="{{generateSortUrl('priority')}}">
                                    {{ __('discount.priority') }} {!! generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($discounts as $discount)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="py-3 font-bold ">
                                    {{ $discount->brand_name }}
                                </td>
                                <td class="py-3 ">
                                    {{ $discount->region_code }}
                                </td>
                                <td class="py-3 ">
                                    {{ $discount->name }}
                                </td>
                                <td class="py-3 ">
                                    {{ $discount->access_type_name }}
                                </td>
                                <td class="py-3 ">
                                    <div
                                        class=" {{ $discount->active ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }} p-1 font-bold uppercase rounded text-xs">
                                        {{ $discount->active ? __('discount.active') : __('discount.inactive') }}
                                    </div>
                                </td>
                                <td class="py-3 ">
                                    @foreach($discount->discount_range as $range)
                                        {{ $range->from_days }} - {{ $range->to_days }}<br/>
                                    @endforeach
                                </td>
                                <td class="py-3 ">
                                    @foreach($discount->discount_range as $range)
                                        {{ $range->code ?? '---' }}<br/>
                                    @endforeach
                                </td>
                                <td class="py-3 ">
                                    @foreach($discount->discount_range as $range)
                                        {{ $range->discount ? $range->discount . '%' : '---' }}<br/>
                                    @endforeach
                                </td>
                                <td class="py-3 ">
                                    {{ $discount->period }}
                                </td>
                                <td class="py-3 ">
                                    {{ $discount->priority }}
                                </td>
                                <td class="px-1 py-3 ">
                                    <a class="cursor-pointer px-4 py-2 bg-blue-600 text-neutral-100 rounded"
                                       href="{{ route('discount.edit', ['discount' => $discount->id]) }}"
                                    >
                                        {{ __('main.edit') }}
                                    </a>
                                </td>
                                <td class="w-12">
                                    <button class="cursor-pointer px-4 py-2 bg-red-600 text-neutral-100 rounded"
                                            data-modal-toggle="confirmDelete{{ $discount->id }}"
                                            type="button"
                                    >
                                        {{ __('main.delete') }}
                                    </button>
                                    <x-modal-delete-confirmation
                                        :id="$discount->id"
                                        :formAction="route('discount.destroy', ['discount' => $discount->id])"
                                    />
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="ml-auto px-10 py-4 max-w-lg">
                    {{ $discounts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
