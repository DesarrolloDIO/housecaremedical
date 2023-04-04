<?php

namespace App\Http\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Admin\ResultTitle;

class ResultDetailsCreate extends Component
{
    
    public $id_use;
    public $eps_use;

    public $texto = 'Crear Detalle';
    public $show = false;

    public $name = '';
    public $response = '';
    public $estatus = 1;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'response' => 'required',
    ];
    
    protected $messages = [
        'response' => 'El campo Response es obligatorio.',
    ];

    public function reset_data()
    {
        $this->name = '';
        $this->response = '';
        $this->estatus = 1;
    }

    public function showModal()
    {
        $this->show = true;
        $this->reset_data();
    }

    public function clouseModal()
    {
        $this->show = false;
        $this->reset_data();
    }

    public function create()
    {
        $this->name                   = trim($this->name);
        $this->response               = trim($this->response);

        $this->validate();

        $user = ResultTitle::create([
            'name'                   => $this->name,
            'response'               => $this->response,
            'eps_id'                 => $this->eps_use,
            'result_id'              => $this->id_use,
            'user_id'                => auth()->user()->id,
            'update_user_id'         => auth()->user()->id
        ]);

        $this->reset_data();

        $this->emit('render');
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.admin.result.result-details-create');
    }
}
