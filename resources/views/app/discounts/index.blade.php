@php
    use App\Helpers\BladeHelper;
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
                        <a href="{{ route('discounts.create') }}">
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
                                    <select class="rounded border-gray-300 w-full" name="brand">
                                        <option disabled selected>{{ __('main.select') }}...</option>
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{ $brand->id }}"
                                                {{ (Request::get('brand') == $brand->id) ? 'selected' : '' }}
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
                                    <a href="{{ route('discounts.index') }}">
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
                                <a href="{{BladeHelper::generateSortUrl('brand_name')}}">
                                    {{ __('discount.brand') }} {!! BladeHelper::generateSorDirectionIcon() !!}
                                </a>

                            </th>
                            <th class="w-20">
                                <a href="{{BladeHelper::generateSortUrl('region_code')}}">
                                    {{ __('discount.region') }} {!! BladeHelper::generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th class="w-32">
                                <a href="{{BladeHelper::generateSortUrl('name')}}">
                                    {{ __('discount.rule_name_label') }} {!! BladeHelper::generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th class="w-24">
                                <a href="{{BladeHelper::generateSortUrl('access_type_name')}}">
                                    {{ __('discount.access_type') }} {!! BladeHelper::generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{BladeHelper::generateSortUrl('active')}}">
                                    {{ __('discount.active') }} {!! BladeHelper::generateSorDirectionIcon() !!}
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
                                <a href="{{BladeHelper::generateSortUrl('start_date')}}">
                                    {{ __('discount.promotion_period') }} {!! BladeHelper::generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th class="w-24">
                                <a href="{{BladeHelper::generateSortUrl('priority')}}">
                                    {{ __('discount.priority') }} {!! BladeHelper::generateSorDirectionIcon() !!}
                                </a>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($discounts as $discount)
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
                                       href="{{ route('discounts.edit', ['discount' => $discount->id]) }}"
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
                                        :formAction="route('discounts.destroy', ['discount' => $discount->id])"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center p-10" colspan="10">
                                    <div class="flex justify-center items-center mt-10">
                                        <div class="group flex items-center">
                                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                            </svg>
                                            {{ __('main.no-entries-found') }}
                                        </div>
                                    </div>

                                </td>
                            </tr>

                        @endforelse
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
