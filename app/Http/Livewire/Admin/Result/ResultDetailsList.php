<?php

namespace App\Http\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Admin\Result;
class ResultDetailsList extends Component
{

    public $id_use;

    protected $listeners = [
        'render'
    ];

    public function render()
    {
        $data = [];
        $data_result = Result::where('id', $this->id_use)->with('resuls_details')->firstOrFail();
        if ($data_result->resuls_details) {
            $data = $data_result->resuls_details;
        }

        // dd($data);

        return view('livewire.admin.result.result-details-list', compact('data'));
    }
}
