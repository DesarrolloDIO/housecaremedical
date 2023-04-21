<?php

namespace App\Http\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Admin\Result;
class ResultDetailsList extends Component
{

    public $id_use;

    public $show = false;
    
    public $id_resultado;
    public $name = '';
    public $response = '';
    public $estatus = 1;

    protected $listeners = [
        'render'
    ];

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'response' => 'required',
    ];

    public function showModalEdit($data){
        $this->show = true;
        
        $this->id_resultado = $data['id'];
        $this->name         = $data['name'];
        $this->response     = $data['response'];
        $this->estatus      = $data['estatus'];
        
    }

    public function reset_data()
    {
        $this->name = '';
        $this->response = '';
        $this->estatus = 1;
    }

    public function clouseModal()
    {
        $this->show = false;
        $this->reset_data();
    }

    public function update()
    {
        $this->name     = trim($this->name);
        $this->response = trim($this->response);

        $this->validate();

        $r = ResultTitle::where('id', $this->id_resultado)->first();
        $r->update([
            'name'           => $this->name,
            'response'       => $this->response,
            'estatus'        => $this->estatus,
            'update_user_id' => auth()->user()->id
        ]);

        $this->show = false;
        $this->emit('render');
    }

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
