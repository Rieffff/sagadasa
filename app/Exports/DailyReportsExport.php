<?php

namespace App\Exports;


use Illuminate\Http\Request; 
use App\Models\DailyReport;
use App\Models\Device;
use App\Models\DailyActivityDetail;
use App\Models\MaintenanceLog;
use App\Models\Contractor;
use App\Models\Company;
use App\Models\Location;
use App\Models\User;
use App\Models\MaintenanceLogAfter;
use App\Models\MaterialReplacement;
use App\Models\DailyActivity;
use App\Models\DailyProblem;
use App\Models\ManPower;
use App\Models\MaintenanceLogDetail;
use App\Models\MaintenanceItem;
use App\Models\MaintenanceLogAfterDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DailyReportsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    // Menerima data dari Controller
    public function __construct($data)
    {
        $this->data = $data;
    }

    // Menggunakan Blade View untuk export
    public function view(): View
    {
        return view('reports.excel', $this->data);
    }
}
