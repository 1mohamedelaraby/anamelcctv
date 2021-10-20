<?php

namespace App\Http\Livewire;

use App\City;
use App\Calculator as CalcModel;
use App\Helpers\MyStr;
use Livewire\Component;
use Illuminate\Support\Str;
use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Support\Facades\DB;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;

class Calculator extends Component
{
    protected $listeners = ['pdfOpened'];

    public $city;
    public $systemType;
    public $indoorCount;
    public $outdoorCount;
    public $selectedIndoorCount = 0;
    public $selectedOutdoorCount = 0;
    public $indoorCamera;
    public $indoorResolution;
    public $indoorQty;
    public $outdoorCamera;
    public $outdoorResolution;
    public $outdoorQty;
    public $indoorProducts = [];
    public $outdoorProducts = [];
    public $dvrProducts = [];
    public $hddProducts = [];

    public $indoorSearch;
    public $outdoorSearch;
    public $dvrSearch;
    public $hddSearch;
    public $indoorCameraQuery;
    public $outdoorCameraQuery;
    public $dvrQuery;
    public $hddQuery;
    public $showIndoorItems = false;
    public $showOutdoorItems = false;
    public $showDvrItems = false;
    public $showHddItems = false;
    protected $results = [];

    public $productsPrice = 0;
    public $shippingCost = 0;
    public $totalPrice = 0;

    public $installment = 0;
    public $installmentCost = 0;
    public $discountPercent = 0;
    public $discount = 0;

    public $showPaymentModal = 0;
    public $payment_type;
    public $payment_fee;
    public $firstName, $lastName, $phone, $email, $address;

    public $priceList;

    public function updatedSystemType()
    {
        $this->indoorProducts = [];
        $this->outdoorProducts = [];
        $this->dvrProducts = [];
        $this->hddProducts = [];
        $this->totalPrice = 0;
        $this->selectedIndoorCount = null;
        $this->selectedOutdoorCount = null;
    }

    public function updatedIndoorQty()
    {
        $this->indoorSearch = null;
    }

    public function updatedOutdoorQty()
    {
        $this->outdoorSearch = null;
    }

    public function updatedInstallment()
    {
        $cameraCost = 0;
        if ($this->installment) {
            $cameraCost = $this->installment == 1 ? 100 : 250;
        }

        $this->installmentCost = ($this->selectedIndoorCount + $this->selectedOutdoorCount) * $cameraCost;

        $this->calculate();
    }

    public function updatedIndoorSearch()
    {
        if ($this->indoorSearch)
            $this->addIndoorProduct($this->indoorSearch);
    }

    public function updatedOutdoorSearch()
    {
        if ($this->outdoorSearch)
            $this->addOutdoorProduct($this->outdoorSearch);
    }

    public function updatedDvrSearch()
    {
        if ($this->dvrSearch)
            $this->addDvrProduct($this->dvrSearch);
    }

    public function updatedHddSearch()
    {
        if ($this->hddSearch)
            $this->addHddProduct($this->hddSearch);
    }

    public function updatedIndoorCount()
    {
        $this->dvrProducts = [];
        $this->totalPrice = 0;
        $this->dvrSearch = null;
        $this->hddSearch = null;
        if ($this->indoorCount < $this->selectedIndoorCount) {
            $this->indoorProducts = [];
            $this->dvrProducts = [];
            $this->hddProducts = [];
            $this->selectedIndoorCount = 0;
        }
    }

    public function updatedOutdoorCount()
    {
        $this->dvrProducts = [];
        $this->hddProducts = [];
        $this->totalPrice = 0;
        $this->dvrSearch = null;
        $this->hddSearch = null;
        if ($this->outdoorCount < $this->selectedOutdoorCount) {
            $this->outdoorProducts = [];
            $this->dvrProducts = [];
            $this->hddProducts = [];
            $this->selectedOutdoorCount = 0;
        }
    }

    public function render()
    {
        $cities = City::orderBy('name', 'ASC')->get();
        $systemTypes = [
            'ip' => 'IP',
            'hd' => 'HD',
        ];
        $maxCameraCount = 16;
        $maxIndoorCount = $maxCameraCount - $this->outdoorCount;
        $maxOutdoorCount = $maxCameraCount - $this->indoorCount;

        $remainingIndoorCount = $this->indoorCount - $this->selectedIndoorCount;
        $remainingOutdoorCount = $this->outdoorCount - $this->selectedOutdoorCount;

        $indoorCountList = $this->selectedIndoorCount + $remainingIndoorCount;
        $outdoorCountList = $this->selectedOutdoorCount + $remainingOutdoorCount;


        $resolutions = [
            'ip' => [
                4 => '4 MP',
                6 => '6 MP',
                8 => '8 MP',
            ],
            'hd' => [
                2 => '2 MP',
                5 => '5 MP',
                8 => '8 MP',
            ]
        ];


        $resolutions = $this->systemType ? $resolutions[$this->systemType] : [];

        $calc_max_resolution = $this->getMaxResolution();
        $ports = $this->getPorts();

        $this->indoorCameraQuery = LarashopProduct::where('calc_type', 'camera')->where('calc_system', $this->systemType)->where('calc_material', 'indoor')->where('calc_resolution', $this->indoorResolution)->get();
        $this->outdoorCameraQuery = LarashopProduct::where('calc_type', 'camera')->where('calc_system', $this->systemType)->where('calc_material', 'outdoor')->where('calc_resolution', $this->outdoorResolution)->get();
        $this->dvrQuery = LarashopProduct::where('calc_type', 'dvr')->where('calc_system', $this->systemType)->where('calc_ports', '>=', $ports)->where('calc_max_resolution', $calc_max_resolution)->get();
        $this->hddQuery = LarashopProduct::where('calc_type', 'hdd')->get();

        $results = $this->results;
        return view('livewire.calculator', compact(
            'cities',
            'systemTypes',
            'maxIndoorCount',
            'maxOutdoorCount',
            'resolutions',
            'indoorCountList',
            'outdoorCountList',
            'remainingIndoorCount',
            'remainingOutdoorCount',
            'results',
        ));
    }

    public function getIndoorSearchResults($search)
    {
        if ($search) {
            return $this->indoorCameraQuery
                ->where('id',  $search);
        }
    }

    public function updated()
    {
        $this->emit('select2');
    }

    public function getOutdoorSearchResults($search)
    {
        if ($search) {
            return $this->outdoorCameraQuery
                ->where('id',  $search);
        }
    }

    public function getDvrSearchResults($search)
    {
        if ($search) {
            return $this->dvrQuery
                ->where('id',  $search);
        }
    }

    public function getHddSearchResults($search)
    {
        if ($search) {
            return $this->hddQuery
                ->where('id',  $search);
        }
    }

    public function addIndoorProduct($id)
    {
        if ($this->indoorQty && $this->indoorResolution) {
            $product =  $this->indoorCameraQuery->find($id);
            $data = [
                'product' => $product,
                'qty' => $this->indoorQty,
                'resolution' => $this->indoorResolution
            ];

            array_push($this->indoorProducts, $data);

            $this->selectedIndoorCount = $this->selectedIndoorCount + $this->indoorQty;
            $this->indoorQty = 0;
            $this->indoorResolution = 0;
            $this->indoorSearch = '';
        }
    }

    public function addOutdoorProduct($id)
    {
        if ($this->outdoorQty && $this->outdoorResolution) {
            $product =  $this->outdoorCameraQuery->find($id);
            $data = [
                'product' => $product,
                'qty' => $this->outdoorQty,
                'resolution' => $this->outdoorResolution,
            ];

            array_push($this->outdoorProducts, $data);

            $this->selectedOutdoorCount = $this->selectedOutdoorCount + $this->outdoorQty;
            $this->outdoorQty = 0;
            $this->outdoorResolution = 0;
            $this->outdoorSearch = '';
        }
    }

    public function addDvrProduct($id)
    {
        if ($this->dvrProducts) {
            $this->dvrProducts = [];
            $this->totalPrice = 0;
        }

        $product =  $this->dvrQuery->find($id);
        $data = [
            'product' => $product,
            'qty' => 1,
            'resolution' => null,
        ];

        array_push($this->dvrProducts, $data);

        $this->dvrSearch = '';
    }

    public function addHddProduct($id)
    {
        if ($this->hddProducts) {
            $this->hddProducts = [];
            $this->totalPrice = 0;
        }

        $product =  $this->hddQuery->find($id);
        $data = [
            'product' => $product,
            'qty' => 1,
            'resolution' => null,
        ];

        array_push($this->hddProducts, $data);

        $this->hddSearch = '';
    }

    public function getMaxResolution()
    {
        $products = collect(array_merge($this->indoorProducts, $this->outdoorProducts));
        return $this->systemType == 'ip' ? 'ip' : @max($products->pluck('resolution')->all());
    }

    public function getPorts()
    {
        $total = $this->outdoorCount + $this->indoorCount;
        if ($total > 8) {
            return 16;
        }

        if ($total > 4) {
            return 8;
        }

        return 4;
    }


    public function calculate()
    {
        $dvrPrice = $this->dvrProducts[0]['product']['price'];
        $hddPrice = $this->hddProducts[0]['product']['price'];
        $products = collect(array_merge($this->indoorProducts, $this->outdoorProducts));
        $productsPrice = 0;
        foreach ($products as $product) {
            $productsPrice += $product['qty'] * $product['product']['price'];
        }

        $this->productsPrice = $productsPrice + $dvrPrice + $hddPrice;

        $cityPrice = 0;
        if ($this->city) {
            $cityPrice = City::find($this->city)->shipping_cost;
        }

        $this->shippingCost = $cityPrice;

        $count = $this->selectedOutdoorCount + $this->selectedIndoorCount;

        if ($count <= 16) {
            $this->discountPercent = 25;
        }

        if ($count <= 8) {
            $this->discountPercent = 20;
        }

        if ($count <= 4) {
            $this->discountPercent = 15;
        }

        $total = $hddPrice + $dvrPrice + $productsPrice + $cityPrice + $this->installmentCost;
        $this->discount = round($total * $this->discountPercent / 100);

        $this->totalPrice = $total - $this->discount;
    }

    public function showModal()
    {
        $this->validate([
            'city' => 'required'
        ]);

        $this->calculate();
        $this->showPaymentModal = 1;
    }

    public function pay()
    {
        $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'payment_type' => 'required',
        ]);

        $this->getPaymentFee();

        $data = [
            'city_id' => $this->city,
            'city' => City::find($this->city)->name,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'payment_type' => $this->payment_type,
            'payment_fee' => $this->payment_fee,
            'price' => $this->totalPrice,
            'shipping_cost' => $this->shippingCost,
            'discount' => $this->discount,
            'installment_type' => $this->installment,
            'installment_cost' => $this->installmentCost,
        ];

        $products = collect(array_merge($this->indoorProducts, $this->outdoorProducts, $this->dvrProducts, $this->hddProducts));
        foreach ($products as $product) {
            $calcDetails[] = [
                'larashop_product_id' => $product['product']['id'],
                'price' => $product['product']['price'],
                'qty' => $product['qty'],
            ];
        }

        DB::transaction(function () use ($data, $calcDetails) {
            $calc = CalcModel::create($data);
            $calc->details()->createMany($calcDetails);

            $className = 'App\PaymentGetway\\' . ucfirst($this->payment_type) . 'Class';
            $class = new $className;

            $class->payCalc($calc);
        });
    }

    public function getPaymentFee()
    {
        if ($this->payment_type) {
            $className = 'App\PaymentGetway\\' . ucfirst($this->payment_type) . 'Class';
            $class = new $className;
            if ($class->getFee()) {
                $this->payment_fee = $class->getFee()['amount'];
                $this->payment_fee_title = $class->getFee()['title'];
            } else {
                $this->payment_fee = 0;
            }
        }
    }

    public function addToCart()
    {
        $products = collect(array_merge($this->indoorProducts, $this->outdoorProducts, $this->dvrProducts));

        foreach ($products as $p) {
            $product = LarashopProduct::find($p['product']['id']);
            LaraShop::addToCart($product, $p['qty']);
            if (auth()->check()) {
                LaraShop::cartLogin(auth()->user());
            }
        }

        return redirect()->route('cart.index');
    }

    public function pdf()
    {
        $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
        ]);

        $products = collect(array_merge($this->indoorProducts, $this->outdoorProducts, $this->dvrProducts, $this->hddProducts));


        $data = [
            'fullName' => $this->firstName . ' ' . $this->lastName,
            'products' => $products,
            'installmentCost' => $this->installmentCost,
            'camerasCount' => $this->indoorCount + $this->outdoorCount,
            'productsTotal' => 0,
            'discountPercent' => $this->discountPercent,
            'discount' => $this->discount,
        ];

        $pdf = LaravelMpdf::loadView('pdf.priceList', $data);
        $username = MyStr::slug($this->firstName . ' ' . $this->lastName);
        $name = $username . '.pdf';
        $pdf->save($name);
        $this->emit('openPdf', $name);
    }

    public function pdfOpened($name)
    {
        unlink($name);
    }
}
