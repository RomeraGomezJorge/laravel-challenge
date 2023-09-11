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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class DiscountController extends Controller
{
    const DISCOUNT_RANGE_COUNTER = 3;

    public function index(Request $request)
    {
        $query = Discount::select(
            'discounts.*',
            'brands.name as brand_name',
            'brands.active as brand_active',
            'access_types.name as access_type_name',
            'regions.code as region_code'
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

        $data = [
            'brands'    => Brand::active()->orderBy('display_order')->get(),
            'regions'   => Region::orderBy('display_order')->get(),
            'discounts' => $discounts,
        ];

        return response()->view('app.discounts.index', $data);
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
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->getRelatedData();
        return response()->view('app.discounts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DiscountStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(DiscountStoreRequest $request)
    {
        $data     = $request->validated();
        $discount = Discount::create($data);
        $discount->discount_range()->createMany($data['discount_ranges']);

        return Redirect::route('discount.index')->with('message', trans('main.store_success'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data             = $this->getRelatedData();
        $data['discount'] = Discount::with(['brand', 'region', 'access_type', 'discount_range'])->find($id);
        return response()->view('app.discounts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DiscountUpdateRequest $request
     * @param Discount $discount
     *
     * @return RedirectResponse
     */
    public function update(DiscountUpdateRequest $request, Discount $discount)
    {
        $data = $request->validated();

        $discount->update($data);

        if (isset($data['discount_ranges'])) {
            $discount->discount_range()->delete();
            $discount->discount_range()->createMany($data['discount_ranges']);
        }

        return redirect()->route('discount.index')->with('message', trans('main.edit_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Discount $discount
     *
     * @return RedirectResponse
     */
    public function destroy(Discount $discount)
    {
        $discount->discount_range()->delete();
        $discount->delete();

        return response()->redirectToRoute('discount.index')->with('message', trans('main.delete_success'));
    }

    /**
     * Retrieve related data for use in create and edit methods.
     *
     * @return array
     */
    private function getRelatedData()
    {
        return [
            'accessTypes'          => AccessType::orderBy('display_order')->get(),
            'brands'               => Brand::active()->orderBy('display_order')->get(),
            'regions'              => Region::orderBy('display_order')->get(),
            'discountRangeCounter' => self::DISCOUNT_RANGE_COUNTER,
        ];
    }

}
