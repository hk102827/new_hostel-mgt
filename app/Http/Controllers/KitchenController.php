<?php

namespace App\Http\Controllers;

use App\Models\KitchenPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;


class KitchenController extends Controller
{
    // List + filters
    public function index(Request $request)
    {
        $query = KitchenPurchase::query();

        if ($request->filled('from')) {
            $query->whereDate('purchase_date', '>=', $request->date('from'));
        }
        if ($request->filled('to')) {
            $query->whereDate('purchase_date', '<=', $request->date('to'));
        }
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $purchases = $query->orderByDesc('purchase_date')->orderByDesc('id')->paginate(20)->withQueryString();

        // Simple categories list from existing rows
        $categories = KitchenPurchase::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('kitchen.index', compact('purchases', 'categories'));
    }

    // Store single entry (from quick add form)
    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_date' => ['required','date'],
            'item_name'     => ['required','string','max:255'],
            'category'      => ['nullable','string','max:100'],
            'quantity'      => ['nullable','numeric','min:0'],
            'unit'          => ['nullable','string','max:20'],
            'unit_price'    => ['nullable','numeric','min:0'],
            'total_cost'    => ['nullable','numeric','min:0'],
            'notes'         => ['nullable','string','max:500'],
        ]);

        // Auto compute total_cost if missing
        if (!isset($data['total_cost']) && isset($data['quantity'], $data['unit_price'])) {
            $data['total_cost'] = (float)$data['quantity'] * (float)$data['unit_price'];
        }

        KitchenPurchase::create($data);
        return back()->with('success', 'Purchase added');
    }

    // Export CSV based on filters (date range + category)
    public function exportCsv(Request $request): StreamedResponse
    {
        $query = KitchenPurchase::query();
        if ($request->filled('from')) {
            $query->whereDate('purchase_date', '>=', $request->date('from'));
        }
        if ($request->filled('to')) {
            $query->whereDate('purchase_date', '<=', $request->date('to'));
        }
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }
        $rows = $query->orderBy('purchase_date')->orderBy('id')->get();

        $filename = 'kitchen_purchases_'.now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        return response()->stream(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['purchase_date','item_name','category','quantity','unit','unit_price','total_cost','notes']);
            foreach ($rows as $r) {
                fputcsv($out, [
                    optional($r->purchase_date)->format('Y-m-d'),
                    $r->item_name,
                    $r->category,
                    $r->quantity,
                    $r->unit,
                    $r->unit_price,
                    $r->total_cost,
                    $r->notes,
                ]);
            }
            fclose($out);
        }, 200, $headers);
    }

    // Monthly report with category-wise breakdown
    public function report(Request $request)
    {
        $year = (int)($request->input('year', now()->year));
        $month = (int)($request->input('month', now()->month));

        $start = now()->setDate($year, $month, 1)->startOfDay();
        $end = (clone $start)->endOfMonth();

        $items = KitchenPurchase::whereBetween('purchase_date', [$start, $end])->get();
        $total = $items->sum('total_cost');
        $byCategory = $items->groupBy('category')->map->sum('total_cost')->sortDesc();

        return view('kitchen.report', compact('year','month','items','total','byCategory'));
    }
    public function edit($id)
    {
        $purchase = KitchenPurchase::findOrFail($id);
        return view('kitchen.edit', compact('purchase'));
    }
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'purchase_date' => 'required|date',
        'item_name'     => 'required|string|max:255',
        'category'      => 'nullable|string|max:255',
        'unit'          => 'nullable|string|max:50',
        'unit_price'    => 'nullable|numeric',
        'total_cost'    => 'nullable|numeric',
        'notes'         => 'nullable|string',
    ]);

    $purchase = KitchenPurchase::findOrFail($id);

    // auto-calc total if not provided
    if (empty($validated['total_cost']) && !empty($validated['unit_price'])) {
        $validated['total_cost'] = $validated['unit_price']; // agar quantity column ho to qty*unit_price karna
    }

    $purchase->update($validated);

    return redirect()->route('admin.kitchen.index')->with('success', 'Purchase updated successfully');
}



    public function destroy($id)
    {
        KitchenPurchase::destroy($id);
        return back()->with('success', 'Kitchen item deleted');
    }
}