<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function downloadReceivable(Request $request)
    {
        $data = [
            'employee_name' => 'safety Worker / safety Worker',
            'position' => 'Safety Worker',
            'nationality' => 'Saudia Arabia ',
            'id_number' => '8765432100',
            'reason' => 'Termination Of Service',
            'work_location' => 'gujarta / gujarta',
            'joining_date' => '30/10/2025',
        ];

        $pdf = Pdf::loadView('pdf.receivable', $data)
            ->setPaper('A4', 'landscape');

        return $pdf->download('receivable_liquidation.pdf');
    }
}
