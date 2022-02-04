<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuStock;
use App\Models\RequestStock;
use App\Models\RestockHistory;
use App\Models\Stock;
use App\Models\StockUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use PDF;

class StocksController extends Controller
{
    const ADD_STOCK_MESSAGE = 'Berhasil menambah stock baru';
    const EDIT_STOCK_MESSAGE = 'Berhasil mengubah rincian stock';
    const ADD_STOCK_QUANTITY_MESSAGE = 'Berhasil menambah jumlah stock (restock)';
    const DELETE_STOCK_MESSAGE = 'Berhasil menghapus stock';
    const DELETE_ERROR_STOCK_MESSAGE = 'Tidak bisa menghapus stock karena saat ini sedang terpakai oleh menu';


    const STOCK_STATUS = [
        'available'         => 'Available',
        'not_available'     => 'Not Available',
        'limited'           => 'Limited'
    ];

    const STOCK_ID = [
        'Mililiter' => 1,
        'Gram'      => 2,
        'Buah'      => 3,
    ];

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
            ->orderBy('stocks.quantity', 'asc')
            ->get();


        return view('admin.stocks.index', [
            'stocks' => $stocks,
        ]);
    }

    public function show($id)
    {

    }

    public function requestStocks()
    {
        $stocks = DB::table('stocks')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->select(
                'stocks.id AS stock_id',
                'stocks.name AS stock_name',
                'stocks.quantity AS stock_quantity',
                'stocks.status AS stock_status',
                'stock_units.name AS unit_name',
            )
            ->orderBy('stocks.quantity', 'asc')
            ->get();

        return view('admin.stocks.requests.request_stocks', [
            'stocks' => $stocks
        ]);
    }

    public function requestStocksInput(Request $r)
    {
        $numberOfValues = 0;

        foreach (array_column($r->stocks, 'request_quantity') as $q) {
            if (isset($q)) {
                $numberOfValues += 1;
            }
        }

        if ($numberOfValues == 0) {
            return redirect()
                ->route('admin_stocks_request_get')
                ->with('admin_stocks_request_error_message', 'Minimal harus mengisi salah satu stock');
        }

        $total = DB::table('request_stocks')
            ->groupBy('request_id')
            ->get()
            ->count();

        $total += 1;

        $order = '';

        if ($total < 10) {
            $order = "0{$total}";
        } else {
            $order = $total;
        }

        $requestId = 'rs-' . date('dmYHi') . '-' . $order;

        foreach ($r->stocks as $stock) {
            if (isset($stock['request_quantity'])) {
                $requestStock = new RequestStock;
                $requestStock->request_id           = $requestId;
                $requestStock->stock_id             = $stock['stock_id'];
                $requestStock->request_quantity     = $stock['request_quantity'];
                $requestStock->processed_quantity   = 0;
                $requestStock->status               = 'Not Accepted';
                $requestStock->save();
            }
        }

        return redirect()
            ->route('admin_stocks_request_get')
            ->with('admin_stocks_request_add_message', 'Berhasil menambahkan data request pengadaan barang');
    }

    public function requestStocksProcess()
    {
        $requestStocks = DB::table('request_stocks')
            ->groupBy('request_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.stocks.requests.request_process_index', [
            'requestStocks' => $requestStocks
        ]);
    }

    public function requestStocksAccept($id)
    {
        DB::table('request_stocks')
            ->where('request_id', '=', $id)
            ->update([
                'status' => 'Accepted'
            ]);

        return redirect()
            ->route('admin_stocks_request_process_get')
            ->with('admin_stocks_request_accept_message', 'Berhasil menyetujui permohonan');
    }

    public function requestStocksProcessInput($id)
    {
        //$requestStock = RequestStock::where('request_id', $id)->get();
        $requestStock = DB::table('request_stocks')
            ->join('stocks', 'request_stocks.stock_id', '=', 'stocks.id')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->select(
                'stocks.id AS stock_id',
                'stocks.name AS stock_name',
                'stock_units.name AS unit_name',
                'request_stocks.id AS request_stock_id',
                'request_stocks.request_id AS request_id',
                'request_stocks.request_quantity AS request_quantity'
            )
            ->where('request_stocks.request_id', '=', $id)
            ->get();

        return view('admin.stocks.requests.request_process_input', [
            'requestStock' => $requestStock,
            'id' => $id
        ]);
    }

    public function requestStocksProcessInputStore($id, Request $r)
    {
        $r->validate(
            [
                'upload_invoice'    => ['required', 'image'],
            ],
            [
                'required'  => 'Data tidak boleh kosong',
                'image'     => 'File harus gambar',
            ]
        );

        foreach ($r->request_stock as $req) {
            //Update `stocks` table
            $stock = Stock::find($req['stock_id']);

            //Only update quantity
            //current quantity + add quantity
            $addedQuantity      = $stock->quantity + $req['processed_quantity'];
            $stock->quantity    = $addedQuantity;

            if ( $addedQuantity > 0 ) {
                switch ($stock->stock_units_id) {
                case self::STOCK_ID['Mililiter']:
                case self::STOCK_ID['Gram']:
                    if ( $addedQuantity <= 1000 ) {
                        $stock->status = self::STOCK_STATUS['limited'];
                    } else {
                        $stock->status = self::STOCK_STATUS['available'];
                    }
                    break;

                case self::STOCK_ID['Buah']:
                    if ( $addedQuantity <= 50 ) {
                        $stock->status = self::STOCK_STATUS['limited'];
                    } else {
                        $stock->status = self::STOCK_STATUS['available'];
                    }
                    break;
                }
            }

            $stock->save();

            $stockId = $stock->id;

            //Add data to `restock_histories` table
            $restock = new RestockHistory;
            $restock->stock_id          = $stockId;
            $restock->stock_units_id    = $stock->stock_units_id;
            $restock->request_id        = $id;
            $restock->name              = $stock->name;
            $restock->quantity          = $req['processed_quantity'];
            $restock->total_price       = $req['price'];

            //Upload invoice
            $image = $r->file('upload_invoice')->store('public/invoices');
            $restock->invoice_image = Storage::url($image);

            $restock->save();

            // Update request_stock
            $requestStock = RequestStock::find($req['request_stock_id']);
            $requestStock->processed_quantity   = $req['processed_quantity'];
            $requestStock->description          = $req['description'];
            $requestStock->price                = $req['price'];
            $requestStock->status               = 'Finish';
            $requestStock->save();
        }

        return redirect()
            ->route('admin_stocks_get')
            ->with('admin_edit_stock_message', self::ADD_STOCK_QUANTITY_MESSAGE);
    }

    public function requestStocksExport($id)
    {
        $currentStocks = DB::table('request_stocks')
            ->join('stocks', 'request_stocks.stock_id', '=', 'stocks.id')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->select(
                'stocks.name AS stock_name',
                'stocks.quantity AS stock_quantity',
                'stock_units.name AS unit_name',
                'stocks.status AS stock_status'
            )
            ->where('request_stocks.request_id', '=', $id)
            ->get();

        $requestStocks = DB::table('request_stocks')
            ->join('stocks', 'request_stocks.stock_id', '=', 'stocks.id')
            ->join('stock_units', 'stocks.stock_units_id', '=', 'stock_units.id')
            ->select(
                'stocks.id AS stock_id',
                'stocks.name AS stock_name',
                'stock_units.name AS unit_name',
                'request_stocks.request_quantity AS request_quantity'
            )
            ->where('request_stocks.request_id', '=', $id)
            ->get();


        $pdf = PDF::loadView('admin.exports.request_stocks_pdf', [
            'id'            => $id,
            'currentStocks'  => $currentStocks,
            'requestStocks' => $requestStocks,
        ]);

        $fileName = 'request-stocks_' . $id . '-' . date('d-m-Y') . '.pdf';

        return $pdf->download($fileName);
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

        switch ($r->unit) {
        case self::STOCK_ID['Mililiter']:
        case self::STOCK_ID['Gram']:
            if ( $r->quantity <= 1000 ) {
                $stock->status = self::STOCK_STATUS['limited'];
            } else {
                $stock->status = self::STOCK_STATUS['available'];
            }
            break;

        case self::STOCK_ID['Buah']:
            if ( $r->quantity <= 50 ) {
                $stock->status = self::STOCK_STATUS['limited'];
            } else {
                $stock->status = self::STOCK_STATUS['available'];
            }
            break;
        }

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
        $image = $r->file('upload_invoice')->store('public/invoices');
        $restock->invoice_image = Storage::url($image);

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
        $availableStatus[2] = 'Limited';

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
        /* $menu = DB::table('menu_stocks') */
        /*     ->join('menus', 'menu_stocks.menu_id', '=', 'menus.id') */
        /*     ->join('stocks', 'menu_stocks.stock_id', '=', 'stocks.id') */
        /*     ->get(); */

        /* die(); */

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
        $addedQuantity      = $stock->quantity + $r->add_quantity;
        $stock->quantity    = $addedQuantity;

        if ( $addedQuantity > 0 ) {
            switch ($stock->stock_units_id) {
            case self::STOCK_ID['Mililiter']:
            case self::STOCK_ID['Gram']:
                if ( $addedQuantity <= 1000 ) {
                    $stock->status = self::STOCK_STATUS['limited'];
                } else {
                    $stock->status = self::STOCK_STATUS['available'];
                }
                break;

            case self::STOCK_ID['Buah']:
                if ( $addedQuantity <= 50 ) {
                    $stock->status = self::STOCK_STATUS['limited'];
                } else {
                    $stock->status = self::STOCK_STATUS['available'];
                }
                break;
            }
        }

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
        $image = $r->file('upload_invoice')->store('public/invoices');
        $restock->invoice_image = Storage::url($image);

        $restock->save();

        return redirect()
            ->route('admin_stocks_get')
            ->with('admin_edit_stock_message', self::ADD_STOCK_QUANTITY_MESSAGE);
    }

    public function delete($id)
    {
        $menuStocks = MenuStock::where('stock_id', $id)->get();

        //Check if this stock is not used by menu
        if ( $menuStocks->isEmpty() ) {
            //Delete stock if stock is not used
            $stock = Stock::find($id);
            $stock->delete();

            return redirect()
                ->route('admin_stocks_get')
                ->with('admin_delete_stock_message', self::DELETE_STOCK_MESSAGE);
        } else {
            return redirect()
                ->route('admin_stocks_get')
                ->with('admin_error_delete_stock_message', self::DELETE_ERROR_STOCK_MESSAGE);
        }
    }
}
