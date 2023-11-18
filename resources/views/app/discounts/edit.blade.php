<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-gray-800 leading-tight">
            <div class="p-6 bg-white border-b border-gray-200 flex">
                <div class="w-2/3">
                    <div class="text-xl text-gray-800 font-bold pb-2">
                        {{ __('discount.edit_discount') }}
                    </div>
                    <div class="text-sm text-blue-500">
                        {{ __('discount.edit_discount_description') }}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <script>
        function check_period_2_enable(load = false) {
            if (load) {
                if ($('input[name="period_1[from_days]"]').val()
                    && $('input[name="period_1[to_days]"]').val()
                    && ($('input[name="period_1[code]"]').val() || $('input[name="period_1[discount]"]').val())) {

                    $("#period_2").find('input').each(function () {
                        $(this).prop('disabled', false).removeClass('bg-neutral-300');
                    });
                    $("#period_2_blackout").addClass('hidden');
                }
            } else {
                if ($('input[name="period_2[from_days]"]').val()
                    || $('input[name="period_2[to_days]"]').val()
                    || ($('input[name="period_2[code]"]').val() || $('input[name="period_2[discount]"]').val())) {

                    $("#period_2").find('input').each(function () {
                        $(this).prop('disabled', false).removeClass('bg-neutral-300');
                    });
                    $("#period_2_blackout").addClass('hidden');
                }
            }
        }

        function check_period_2_disable() {
            if (!$('input[name="period_1[from_days]"]').val()
                || !$('input[name="period_1[to_days]"]').val()
                || (!$('input[name="period_1[code]"]').val() && !$('input[name="period_1[discount]"]').val())) {

                $("#period_2").find('input').each(function () {
                    $(this).val('');
                    $(this).prop('disabled', true).addClass('bg-neutral-300');
                });
                $("#period_3").find('input').each(function () {
                    $(this).val('');
                    $(this).prop('disabled', true).addClass('bg-neutral-300');
                });
                $("#period_2_blackout").removeClass('hidden');
            }
        }

        function check_period_3_enable(load = false) {
            if (load) {
                if ($('input[name="period_2[from_days]"]').val()
                    && $('input[name="period_2[to_days]"]').val()
                    && ($('input[name="period_2[code]"]').val() || $('input[name="period_2[discount]"]').val())) {

                    $("#period_3").find('input').each(function () {
                        $(this).prop('disabled', false).removeClass('bg-neutral-300');
                    });
                    $("#period_3_blackout").addClass('hidden');
                }
            } else {
                if ($('input[name="period_3[from_days]"]').val()
                    || $('input[name="period_3[to_days]"]').val()
                    || ($('input[name="period_3[code]"]').val() || $('input[name="period_3[discount]"]').val())) {

                    $("#period_3").find('input').each(function () {
                        $(this).prop('disabled', false).removeClass('bg-neutral-300');
                    });
                    $("#period_3_blackout").addClass('hidden');
                }
            }
        }

        function check_period_3_disable() {
            if (!$('input[name="period_2[from_days]"]').val()
                || !$('input[name="period_2[to_days]"]').val()
                || (!$('input[name="period_2[code]"]').val() && !$('input[name="period_2[discount]"]').val())) {

                $("#period_3").find('input').each(function () {
                    $(this).val('');
                    $(this).prop('disabled', true).addClass('bg-neutral-300');
                });
                $("#period_3_blackout").removeClass('hidden');
            }
        }

        $(document).ready(function () {
            check_period_2_enable();
            check_period_3_enable();

            $("#period_1").find("input").each(function () {
                $(this).on('blur', function () {
                    check_period_2_disable();
                });
            });
            $("#period_2").find("input").each(function () {
                $(this).on('blur', function () {
                    check_period_3_disable();
                });
            });

            $("#enable_period_2").on('click', function () {
                check_period_2_enable(true);
            });

            $("#enable_period_3").on('click', function () {
                check_period_3_enable(true);
            });

            $("form").submit(function () {
                if (!$('input[name="period_3[from_days]"]').val()
                    && !$('input[name="period_3[to_days]"]').val()
                    && (!$('input[name="period_3[code]"]').val() && !$('input[name="period_3[discount]"]').val())) {

                    $("#period_3").find('input').each(function () {
                        $(this).prop('disabled', true);
                    });
                }

                if (!$('input[name="period_2[from_days]"]').val()
                    && !$('input[name="period_2[to_days]"]').val()
                    && (!$('input[name="period_2[code]"]').val() && !$('input[name="period_2[discount]"]').val())) {

                    $("#period_2").find('input').each(function () {
                        $(this).prop('disabled', true);
                    });
                }
            });
        });
    </script>

    <div class="py-12">
        @if($errors->any())
            <div class="max-w-6xl mx-auto mb-5 px-4 py-2 bg-red-200 border border-red-500 rounded-lg">
                @foreach($errors->all() as $error)
                    {{ $error }} <br/>
                @endforeach
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg pl-10 pr-4 py-2">
                <form action="{{ route('discounts.update', ['discount' => $discount->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $discount->id }}" name="id">
                    <x-discount-form
                        :brands="$brands"
                        :accessTypes="$accessTypes"
                        :regions="$regions"
                        :discountRangeCounter="$discountRangeCounter"
                        :discount="$discount"
                    />
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
