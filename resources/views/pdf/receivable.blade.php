<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Receivables liquidation</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            position: relative;
        }
        .bg {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .overlay {
            position: absolute;
            z-index: 1;
        }
        .field-employee {
            top: 50px;
            left: 40px;
            width: 420px;
        }
        .field-position {
            top: 85px;
            left: 40px;
            width: 420px;
        }
        .field-nationality {
            top: 120px;
            left: 40px;
            width: 420px;
        }
        .field-id {
            top: 155px;
            left: 40px;
            width: 420px;
        }
        .field {
            position: absolute;
            font-size: 12px;
            color: #000;
        }
        .field-join-date {
            top: 300px;
            left: 300px;
            width: 160px;
            text-align: center;
        }
        .signature {
            bottom: 120px;
            left: 40px;
            width: 420px;
        }
    </style>
</head>
<body>
    <img src="{{ public_path('images/form-template.jpg') }}" class="bg" />
    <div class="overlay">
        <div class="field field-employee">
            <strong>Employee Name:</strong> {{ $employee_name }}
        </div>
        <div class="field field-position">
            <strong>Position:</strong> {{ $position }}
        </div>
        <div class="field field-nationality">
            <strong>Nationality:</strong> {!! nl2br(e($nationality)) !!}
        </div>
        <div class="field field-id">
            <strong>ID Number:</strong> {{ $id_number }}
        </div>
        <div class="field field-join-date">
            <strong>Joining Date</strong><br>
            {{ $joining_date }}
        </div>
        <div class="field" style="top:200px; left:40px;">
            <strong>Work Location:</strong> {{ $work_location }}
        </div>
        <div class="field" style="top:220px; left:40px;">
            <strong>Reason for Liquidation:</strong> {{ $reason }}
        </div>
        <div class="field signature">
            <strong>Name:</strong> {{ $employee_name }} <br
            <strong>Signature:</strong> ____________________ <br>
            <strong>Date:</strong> ____________________
        </div>
    </div>
</body>
</html>
Perfect! Ab main aapko **complete ready-to-use Laravel 12 project setup** de raha hoon jisme:

✅ Assignment PDF jaisa **Invoice Blade Template**
✅ Controller se **Dynamic Data**
✅ DOMPDF se **PDF Generate + Download**
✅ Routes
✅ CSS layout (simple clean design)
✅ Fully working code

Aap direct copy → paste → run kar sakte ho.

---

# 🚀 **STEP 1: Install Package**

```bash
composer require barryvdh/laravel-dompdf
```

---

# 🚀 **STEP 2: Create Route**

📌 File → `routes/web.php`

```php
use App\Http\Controllers\InvoiceController;

Route::get('/invoice-pdf', [InvoiceController::class, 'generatePDF']);
```

---

# 🚀 **STEP 3: Create Controller**

📌 File → `app/Http/Controllers/InvoiceController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generatePDF()
    {

        $data = [
            'invoice_no' => 'INV-1001',
            'date_issue' => date('m/d/Y'),
            'due_date' => date('m/d/Y', strtotime('+7 days')),
            'customer_name' => 'Customer Name Here',
            'business_name' => 'Your Business Name',
            'street_1' => 'Street Address 01',
            'street_2' => 'Street Address 02',
            'email' => 'example@gmail.com',
            'phone' => '+1 (999)-999-9999',
            'website' => 'www.example.com',


            'items' => [
                ['name' => 'Item 1', 'qty' => 2, 'rate' => 500],
                ['name' => 'Item 2', 'qty' => 3, 'rate' => 300],
                ['name' => 'Item 3', 'qty' => 1, 'rate' => 800],
            ],

            'discount' => 20,
            'tax_rate' => 5,
        ];


        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $subtotal += $item['qty'] * $item['rate'];
        }


        $tax_amount = ($subtotal * $data['tax_rate']) / 100;


        $total = $subtotal + $tax_amount - $data['discount'];


        $data['subtotal'] = $subtotal;
        $data['tax_amount'] = $tax_amount;
        $data['total'] = $total;

        $pdf = Pdf::loadView('invoice', $data);

        return $pdf->download('invoice.pdf');
    }
}
