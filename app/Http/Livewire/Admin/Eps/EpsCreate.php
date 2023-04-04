<?php

namespace App\Http\Livewire\Admin\Eps;

use Livewire\Component;
use App\Models\Admin\Eps;

class EpsCreate extends Component
{
    public $texto = 'Crear Eps';
    public $show = false;

    public $name = '';
    public $phone = '';
    public $address = '';
    public $email = '';
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

        $eps = Eps::create([
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
        $this->emit('eps_created', $eps->id);
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.admin.eps.eps-create');
    }
}
