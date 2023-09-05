@props([
    'brands',
    'accessTypes',
    'regions',
    'discountRangeCounter',
    'discount' => null,
])

<div class="flex flex-wrap items-center mt-4">
    <div class="flex flex-col">
        <div class="flex flex-row items-center">
            <label
                for="name"
                class="h-full font-bold w-1/3"
            >
                {{ __('discount.rule_name_label') }}
            </label>
            <div class="w-1/3">
                <input
                    name="name"
                    id="name"
                    type="text"
                    class="border border-gray-300 rounded rounded-md text-neutral-700 w-full  @error('name') mt-3 border-red-500 @enderror"
                    value="{{ $discount->name ?? old('name') }}"
                />
                @error("name")
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="bg-gray-200 text-gray-500 ml-4 py-2 px-4 rounded w-1/3">
                {{ __('discount.rule_name_helper') }}
            </div>

        </div>
    </div>

    <label for="active" class="ml-auto">{{ __('discount.active') }}</label>
    <input
        name="active"
        id="active"
        type="hidden"
        value="0"
    />
    <input
        name="active"
        id="activeCheckbox"
        type="checkbox"
        class="form-check-input mx-4 @error('active') is-invalid @enderror"
        value="1"
        {{ $discount ? ($discount->active ? 'checked' : '') : (old('active') ? 'checked' : '') }}
    />
    @error('active')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<hr class="my-8">
<div class="flex gap-8">
    <div class="flex flex-col w-1/4">
        <div class="font-bold ml-2">
            {{ __('discount.brand') }}
        </div>
        <div>
            <select
                class="rounded border-gray-300 w-full @error('brand_id') border-red-500 @enderror"
                name="brand_id"
            >
                @foreach($brands as $brand)
                    <option
                        value="{{ $brand->id }}"
                        {{ $discount && $discount->brand->id == $brand->id ? 'selected' : '' }}
                    >
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            @error('brand_id')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col w-1/4">
        <div class="font-bold ml-2">
            {{ __('discount.access_type') }}
        </div>
        <div>
            <select
                class="rounded border-gray-300 w-full @error('access_type_code') border-red-500 @enderror"
                name="access_type_code"
            >
                @foreach($accessTypes as $accessType)
                    <option
                        value="{{ $accessType->code }}"
                        {{  $discount && $discount->access_type->code == $accessType->code ? 'selected' : '' }}
                    >
                        {{ $accessType->name }}
                    </option>
                @endforeach
            </select>
            @error('access_type_code')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col w-1/4">
        <div class="font-bold ml-2">
            {{ __('discount.priority') }}
        </div>
        <div class="h-full w-full">
            <input
                type="text"
                class="border border-gray-300 rounded rounded-md text-neutral-700 w-full @error('priority') border-red-500 @enderror"
                name="priority"
                value="{{  $discount->priority ?? old('priority') }}"
            />
            @error('priority')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="flex flex-col w-1/4">
        <div class="font-bold ml-2">
            {{ __('discount.region') }}
        </div>
        <div>
            <select
                class="rounded border-gray-300 w-full" @error('region_id') border-red-500 @enderror
            name="region_id"
            >
                @foreach($regions as $region)
                    <option
                        value="{{ $region->id }}"
                        {{ $discount && $discount->region->id == $region->id ? 'selected' : '' }}
                    >
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
            @error('region_id')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<hr class="my-8">
<div class="bg-gray-200 text-gray-700 p-8 text-sm rounded-lg">
    {{ __('discount.magnament_discount_info') }}
</div>
<hr class="my-8">
<div class="flex gap-2">
    @for ($discountRangeIndex = 0; $discountRangeIndex < $discountRangeCounter; $discountRangeIndex++)
        <div
            id="period_{{ $discountRangeIndex }}"
            class="flex flex-wrap w-1/3 border border-gray-100 rounded rounded-lg"
        >
            <div class="p-5 w-full max-w-full">
                <div class="text-sky-800 font-bold w-full">
                    {{ __('discount.application_period') }} {{$discountRangeIndex}}
                </div>
                <div class="flex space-x-2 mt-2 flex-row">
                    <div class="w-1/2 flex-col">
                        <input
                            class="w-full border-gray-400 rounded {{ $discountRangeIndex > 1 ? 'bg-neutral-300' :'' }}"
                            name="discount_ranges[{{ $discountRangeIndex }}][from_days]"
                            type="text"
                            placeholder="{{ __('discount.from') }}..."
                            value="{{ isset($discount->discount_range[$discountRangeIndex]['from_days'])
                                        ? $discount->discount_range[$discountRangeIndex]['from_days']
                                        : old("discount_ranges.$discountRangeIndex.from_days")
                                    }}"
                            {{ $discountRangeIndex > 1 ? 'disabled' :'' }}
                        />
                        @foreach($errors->get("discount_ranges.$discountRangeIndex.from_days") as $error)
                            <div class="w-full text-red-600 text-sm mt-1">{{ $error }}</div>
                        @endforeach
                    </div>
                    <div class="w-1/2 flex-col">
                        <input
                            class="w-full border-gray-400 rounded {{ $discountRangeIndex > 1 ? 'bg-neutral-300' :'' }}"
                            name="discount_ranges[{{ $discountRangeIndex }}][to_days]"
                            type="text"
                            placeholder="{{ __('discount.to') }}..."
                            value="{{ isset($discount->discount_range[$discountRangeIndex]['to_days'])
                                        ? $discount->discount_range[$discountRangeIndex]['to_days']
                                        : old("discount_ranges.$discountRangeIndex.to_days")
                                    }}"
                            {{ $discountRangeIndex > 1 ? 'disabled' :'' }}
                        />
                        @error("discount_ranges.$discountRangeIndex.to_days")
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr class="w-full">
            <div class="p-5 w-full max-w-full">
                <div class="text-gray-700 font-bold w-full">
                    {{ __('discount.awd_bcd_discount_code') }}
                </div>
                <div class="flex mt-2 flex-col">
                    <input
                        class="w-full border-gray-400 rounded {{ $discountRangeIndex > 1 ? 'bg-neutral-300' :'' }}"
                        name="discount_ranges[{{ $discountRangeIndex }}][code]"
                        type="text"
                        placeholder="{{ __('discount.code') }}..."
                        value="{{ isset($discount->discount_range[$discountRangeIndex]['code'])
                                    ? $discount->discount_range[$discountRangeIndex]['code']
                                    : old("discount_ranges.$discountRangeIndex.code")
                                }}"
                        {{ $discountRangeIndex > 1 ? 'disabled' :'' }}
                    />
                    @error("discount_ranges.$discountRangeIndex.code")
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="p-5 w-full max-w-full">
                <div class="text-gray-700 font-bold w-full">
                    {{ __('discount.gsa_discount_percentage') }}
                </div>
                <div class="flex mt-2 flex-col">
                    <input
                        class="w-full border-gray-400 rounded {{ $discountRangeIndex > 1 ? 'bg-neutral-300' :'' }}"
                        name="discount_ranges[{{ $discountRangeIndex }}][discount]"
                        type="text"
                        placeholder="{{ __('discount.discount') }}..."
                        value="{{ isset($discount->discount_range[$discountRangeIndex]['discount'])
                                    ? $discount->discount_range[$discountRangeIndex]['discount']
                                    : old("discount_ranges.$discountRangeIndex.discount")
                                 }}"
                        {{ $discountRangeIndex > 1 ? 'disabled' :'' }}
                    />
                    @error("discount_ranges.$discountRangeIndex.discount")
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endfor
</div>
<hr class="my-8">
<div class="bg-gray-200 text-gray-700 p-8 text-sm rounded-lg">
    {{ __('discount.magnament_discount_info') }}
</div>
<hr class="my-8">
<div>
    <div class="flex space-x-2">
        <div class="m-3 font-bold w-1/6 ">
            {{ __('discount.application_period') }}
        </div>
        <div class="flex justify-between w-1/6">
            <div class="">
                <input
                    name="start_date"
                    type="date"
                    class="border border-gray-300 rounded rounded-md text-neutral-700   @error('start_date') border-red-500 @enderror"
                    placeholder="{{ __('discount.start_date') }}"
                    value="{{ $discount ? $discount->getStartDateFormated() : old('start_date') }}"
                />
                @error('start_date')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <span class="m-3 text-gray-500">-</span>
            <div class="">
                <input
                    name="end_date"
                    type="date"
                    class="border border-gray-300 rounded rounded-md text-neutral-700 @error('end_date') border-red-500 @enderror"
                    placeholder="{{ __('discount.end_date') }}"
                    value="{{ $discount ? $discount->getEndDateFormated() : old('end_date') }}"
                />
                @error('end_date')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="mb-12">
    <div class="flex justify-end gap-4">
        <a
            href="{{ route('discount.index') }}">
            <div
                class="font-bold bg-gray-200 border border-gray-300 rounded py-2 px-4 cursor-default">
                {{ __('main.cancel') }}
            </div>
        </a>
        <input
            type="submit"
            class="font-bold text-neutral-200 bg-blue-600 border border-blue-900 rounded py-2 px-4"
            value="{{ __('main.save') }}"
        />
    </div>
</div>
<script>


    function isPeriodCompleted(index) {
        const getInputValue = (inputName) => {
            return $("input[name='discount_ranges[" + index + "][" + inputName + "]']").val();
        };

        const fromDays = getInputValue("from_days");
        const toDays = getInputValue("to_days");
        const code = getInputValue("code");
        const discount = getInputValue("discount");

        const isFromDaysNumeric = $.isNumeric(fromDays);
        const isToDaysNumeric = $.isNumeric(toDays);
        const isCodeProvided = code !== "";
        const isDiscountProvided = discount !== "";
        const isCodeAlphaNumeric = /^[a-zA-Z0-9]+$/.test(code);
        const isDiscountNumeric = $.isNumeric(discount);

        if (!isCodeProvided && !isDiscountProvided) {
            return false;
        }

        if (isCodeProvided && !isCodeAlphaNumeric) {
            return false;
        }

        if (isDiscountProvided && !isDiscountNumeric) {
            return false;
        }

        if (!isFromDaysNumeric || !isToDaysNumeric || parseInt(fromDays) >= parseInt(toDays)) {
            return false;
        }

        return true;
    }

    function toggleInputDisabled(index, disabled, clearValues) {
        const inputNames = ["from_days", "to_days", "code", "discount"];

        for (const inputName of inputNames) {
            const inputSelector = $("input[name='discount_ranges[" + index + "][" + inputName + "]']");
            inputSelector.prop("disabled", disabled);
            if (clearValues) {
                inputSelector.val('');
            }

            (disabled)
                ? inputSelector.addClass('bg-neutral-300')
                : inputSelector.removeClass('bg-neutral-300');
        }
    }

    function validateInput(index) {
        if (isPeriodCompleted(index)) {
            toggleInputDisabled(index + 1, false, false);
        } else {
            toggleInputDisabled(index + 1, true, true);
        }
    }

    $(document).ready(function () {

        // Manejar la validación en la carga de la página
        $("input[name^='discount_ranges']").each(function () {
            const fieldName = $(this).attr("name");
            const regex = /discount_ranges\[(\d+)\]/;
            const match = fieldName.match(regex);

            if (match) {
                const index = parseInt(match[1]);
                validateInput(index);
            }
        });

        $("input[name^='discount_ranges']").on("input", function () {

            const fieldName = $(this).attr("name");
            const regex = /discount_ranges\[(\d+)\]/;
            const match = fieldName.match(regex);

            if (match) {
                const index = parseInt(match[1]);
                validateInput(index);
            }
        });
    });

</script>

