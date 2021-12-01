<?php

namespace App\Http\Controllers;

use App\Models\RestockHistory;
use App\Models\Stock;
use App\Models\StockUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StocksController extends Controller
{
    const ADD_STOCK_MESSAGE = 'Berhasil menambah stock baru';
    const EDIT_STOCK_MESSAGE = 'Berhasil mengubah rincian stock';
    const ADD_STOCK_QUANTITY_MESSAGE = 'Berhasil menambah jumlah stock (restock)';

    //
    public function index(Request $r)
    {
        $stocks = DB::table('stocks')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->select(
                'stocks.id AS stock_id',
                'stocks.name AS stock_name',
                'stocks.quantity AS stock_quantity',
                'stocks.status AS stock_status',
                'stock_units.name AS unit_name',
                'stocks.created_at AS stock_created_at'
            )
            ->get();


        return view('admin.stocks.index', [
            'stocks' => $stocks,
        ]);
    }

    public function show($id)
    {

    }

    public function create()
    {
        $stockUnits = StockUnit::all();

        return view('admin.stocks.create', [
            'units' => $stockUnits,
        ]);
    }

    public function store(Request $r)
    {
        $r->validate(
            [
                'name'              => ['required', 'min:3', 'unique:App\Models\Stock,name'],
                'quantity'          => ['required', 'min:1', 'numeric'],
                'unit'              => ['required'],
                'total_price'       => ['required', 'min:1', 'numeric'],
                'upload_invoice'    => ['required', 'image'],
            ],
            [
                'name.required'             => 'Mohon untuk mengisi nama stock',
                'name.min'                  => 'Minimal nama 3 karakter',
                'name.unique'               => 'Nama stock telah terdaftar',
                'quantity.required'         => 'Mohon untuk mengisi jumlah stock',
                'quantity.min'              => 'Minimal jumlah stock adalah 1 atau tidak boleh kosong',
                'unit.required'             => 'Mohon untuk mengisi unit stock',
                'total_price.required'      => 'Mohon untuk mengisi total belanja stock',
                'total_price.min'           => 'Total belanja tidak boleh nol atau kosong',
                'upload_invoice.required'   => 'Mohon untuk melampirkan bukti pembelian',
                'upload_invoice.image'      => 'File harus gambar',
            ]
        );

        //Add data to `stocks` table
        $stock                  = new Stock;
        $stock->stock_units_id  = $r->unit;
        $stock->name            = $r->name;
        $stock->quantity        = $r->quantity;
        $stock->status          = 'Available';
        $stock->save();

        $stockId = $stock->id;

        //Add data to `restock_histories` for restock history
        $restock                    = new RestockHistory();
        $restock->stock_id          = $stockId;
        $restock->stock_units_id    = $r->unit;
        $restock->name              = $r->name;
        $restock->quantity          = $r->quantity;
        $restock->total_price       = $r->total_price;

        //Upload invoice
        $image = $r->file('upload_invoice')->store('invoices');
        $restock->invoice_image = $image;

        $restock->save();

        return redirect()
            ->route('admin_stocks_get')
            ->with('admin_add_stock_message', self::ADD_STOCK_MESSAGE);
    }

    public function edit($id)
    {
        $stock = DB::table('stocks')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->select(
                'stocks.id AS stock_id',
                'stocks.name AS stock_name',
                'stocks.quantity AS stock_quantity',
                'stocks.status AS stock_status',
                'stock_units.name AS unit_name',
                'stocks.created_at AS stock_created_at'
            )
            ->where('stocks.id', '=', $id)
            ->first();

        if ( !isset( $stock ) ) {
            abort( 404 );
        }

        $units = StockUnit::all();

        $availableStatus[0] = 'Available';
        $availableStatus[1] = 'Not Available';

        return view('admin.stocks.edit_details', [
            'stock' => $stock,
            'units' => $units,
            'availableStatus' => $availableStatus,
        ]);
    }

    public function update(Request $r, $id)
    {
        $r->validate(
            [
                'name' => ['required', 'min:3']
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.min'      => 'Minimal nama harus 3 karakter'
            ]
        );

        $stock = Stock::find($id);
        $stock->stock_units_id  = $r->unit;
        $stock->name            = $r->name;
        $stock->status          = $r->status;
        $stock->save();

        $stockId = $stock->id;

        //Also update the name on restock_histories table
        $histories = RestockHistory::where('stock_id', $stockId)->get();

        foreach ($histories as $h) {
            $updateHistory = RestockHistory::find($h->id);
            $updateHistory->stock_units_id = $r->unit;
            $updateHistory->name = $r->name;
            $updateHistory->save();
        }


        return redirect()
            ->route('admin_stocks_get')
            ->with('admin_edit_stock_message', self::EDIT_STOCK_MESSAGE);
    }

    public function editAddQuantity($id)
    {

        $stock = DB::table('stocks')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->select(
                'stocks.id AS stock_id',
                'stocks.name AS stock_name',
                'stocks.quantity AS stock_quantity',
                'stocks.status AS stock_status',
                'stock_units.name AS unit_name',
                'stocks.created_at AS stock_created_at'
            )
            ->where('stocks.id', '=', $id)
            ->first();

        if ( !isset( $stock ) ) {
            abort(404);
        }

        return view('admin.stocks.edit_add_quantity', [
            'stock' => $stock,
        ]);
    }

    //Restock function (edit)
    public function updateAddQuantity(Request $r, $id)
    {
        $r->validate(
            [
                'add_quantity'      => ['required', 'numeric', 'min:1'],
                'upload_invoice'    => ['required', 'image'],
                'total_price'       => ['required', 'numeric', 'min:1']
            ],
            [
                'required'  => 'Data tidak boleh kosong',
                'min'       => 'Jumlah minimal adalah 1',
                'image'     => 'File harus gambar',
            ]
        );

        //Update `stocks` table
        $stock = Stock::find($id);

        //Only update quantity
        //current quantity + add quantity
        $stock->quantity = $stock->quantity + $r->add_quantity;
        $stock->save();

        $stockId = $stock->id;

        //Add data to `restock_histories` table
        $restock = new RestockHistory;
        $restock->stock_id          = $stockId;
        $restock->stock_units_id    = $stock->stock_units_id;
        $restock->name              = $stock->name;
        $restock->quantity          = $r->add_quantity;
        $restock->total_price       = $r->total_price;

        //Upload invoice
        $image = $r->file('upload_invoice')->store('invoices');
        $restock->invoice_image = $image;

        $restock->save();

        return redirect()
            ->route('admin_stocks_get')
            ->with('admin_edit_stock_message', self::ADD_STOCK_QUANTITY_MESSAGE);
    }

    public function delete($id)
    {

    }
}
