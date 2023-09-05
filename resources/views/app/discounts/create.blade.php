<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-gray-800 leading-tight">
            <div class="p-6 bg-white border-b border-gray-200 flex">
                <div class="w-2/3">
                    <div class="text-xl text-grayz-800 font-bold pb-2">
                        {{ __('app/discounts/create.create_discount') }}
                    </div>
                    <div class="text-sm text-blue-500">
                        {{ __('app/discounts/create.create_discount_description') }}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
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
                <form action="{{ route('discount.store') }}" method="POST">
                    @csrf
                    <x-discount-form
                        :brands="$brands"
                        :accessTypes="$accessTypes"
                        :regions="$regions"
                        :discountRangeCounter="$discountRangeCounter"
                    />
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
