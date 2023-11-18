<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountStoreRequest;
use App\Http\Requests\DiscountUpdateRequest;
use App\Models\AccessType;
use App\Models\Brand;
use App\Models\Discount;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DiscountController extends Controller
{
    const DISCOUNT_RANGE_COUNTER = 3;

    public function index(Request $request): View
    {
        $query = Discount::select(
            'discounts.id',
            'discounts.name',
            'discounts.active',
            'discounts.priority',
            'discounts.start_date',
            'discounts.end_date',
            'brands.active as brand_active',
            'brands.name as brand_name',
            'access_types.name as access_type_name',
            'regions.code as region_code',
        )
            ->with('discount_range')
            ->join('brands', 'discounts.brand_id', '=', 'brands.id')
            ->join('regions', 'discounts.region_id', '=', 'regions.id')
            ->join('access_types', 'discounts.access_type_code', '=', 'access_types.code')
            ->where('brands.active', 1);

        $this->applyFilters($request, $query);

        $orderBy       = $request->input('order_by', 'name');
        $sortDirection = $request->input('direction', 'asc');

        $query->orderBy($orderBy, $sortDirection);

        $discounts = $query->paginate(10);

        $data = $this->getRelatedData();
        $data['discounts'] = $discounts;

        return view('app.discounts.index', $data);
    }

    private function applyFilters(Request $request, $query)
    {
        $query->when($request->filled('brand'), function ($q) use ($request) {
            return $q->where('brand_id', $request->input('brand'));
        })
            ->when($request->filled('region'), function ($q) use ($request) {
                return $q->where('region_id', $request->input('region'));
            })
            ->when($request->filled('discount_name'), function ($q) use ($request) {
                return $q->where('discounts.name', 'like', '%' . $request->input('discount_name') . '%');
            })
            ->when($request->filled('awd_bcd_code'), function ($q) use ($request) {
                return $q->whereHas('discount_range', function ($subQuery) use ($request) {
                    $subQuery->where('code', $request->input('awd_bcd_code'));
                });
            });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('app.discounts.create', $this->getRelatedData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountStoreRequest $request): RedirectResponse
    {
        DB::transaction(function() use ($request) {
            $data     = $request->validated();
            $discount = Discount::create($data);
            $discount->discount_range()->createMany($data['discount_ranges']);
        });

        return redirect()->route('discounts.index')->with('message', trans('main.store_success'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        $data             = $this->getRelatedData();
        $data['discount'] = $discount;
        return view('app.discounts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountUpdateRequest $request, Discount $discount):RedirectResponse
    {
        DB::transaction(function() use ($request,$discount) {
            $data = $request->validated();
            $discount->update($data);
            $discount->discount_range()->delete();
            $discount->discount_range()->createMany($data['discount_ranges']);
        });

        return redirect()->route('discounts.index')->with('message', trans('main.edit_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount): View
    {
        DB::transaction(function () use ($discount) {
            $discount->discount_range()->delete();
            $discount->delete();
        });

        return view('discount.index')->with('message', trans('main.delete_success'));
    }

    /**
     * Retrieve related data for use in index, create and edit methods.
     * Caching static data that doesn't change frequently.
     */
    private function getRelatedData(): array
    {
        $hour = 60 * 60;

        $accessType = Cache::remember('accessTypes', 24 * $hour, function () {
            return AccessType::all(['code','name']);
        });

        $brands = Cache::remember('brands', 24 * $hour, function () {
            return Brand::active(['id','name'])->get();
        });

        $regions = Cache::remember('regions', 24 * $hour, function () {
            return Region::all(['id','name']);
        });

        return [
            'accessTypes'          => $accessType,
            'brands'               => $brands,
            'regions'              => $regions,
            'discountRangeCounter' => self::DISCOUNT_RANGE_COUNTER,
        ];
    }

}
