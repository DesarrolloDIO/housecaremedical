<?php

namespace App\Http\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Admin\Eps;

class ResultCreate extends Component
{
    public $texto = 'Crear Resultado';
    public $show = false;

    public $code;
    public $patient_identification;
    public $identification_type;
    public $name;
    public $age;
    public $email;
    public $eps_id;
    public $estatus = 1;

    
    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:eps'],
        'estatus' => 'required',
    ];

    public function reset_data()
    {
        $this->name = '';
        $this->phone = '';
        $this->address = '';
        $this->email = '';
        $this->estatus = 1;
    }

    public function showModal()
    {$this->show = true;
        $this->reset_data();
    }

    public function clouseModal()
    {
        $this->show = false;
        $this->reset_data();
    }

    public function create()
    {

        $this->name    = trim($this->name);
        $this->phone   = trim($this->phone);
        $this->address   = trim($this->address);
        $this->email   = trim($this->email);

        $this->validate();

        $user = Result::create([
            'name'    => $this->name,
            'phone'   => $this->phone,
            'address' => $this->address,
            'email'   => $this->email,
            'estatus' => $this->estatus,
            'user_id' => auth()->user()->id,
            'update_user_id' => auth()->user()->id
        ]);

        $this->reset_data();

        $this->emit('render');
        $this->show = false;
    }

    public function render()
    {
        $eps = Eps::get();
        return view('livewire.admin.result.result-create', compact('eps'));
    }
}
