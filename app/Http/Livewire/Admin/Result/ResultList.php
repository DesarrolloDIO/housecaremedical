<?php

namespace App\Http\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Admin\Result;
use Livewire\WithPagination;

class ResultList extends Component
{
    use WithPagination;

    protected $listeners = ['render'];

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 10]
    ];

    public function rules(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,name,'.$this->id_use],
        ];
    }

    public $search = '';
    public $per_page = 10;

    public $show = false;
    public $show_view = false;
    public $id_use = '';
    public $nombre = '';

    public $nombre_delete = false;
    public $show_no_delete = false;
    public $show_confirmation_delete = false;

    public $code;
    public $patient_identification;
    public $identification_type;
    public $name;
    public $age;
    public $email;
    public $eps_id;
    public $estatus = 1;



    public function showModalEdit($data){
        $this->id_use = $data['id'];
        $this->show = true;

        $this->name    = $data['name'];
        $this->phone   = $data['phone'];
        $this->address = $data['address'];
        $this->email   = $data['email'];
        $this->estatus = $data['estatus'];
        
    }

    public function showModalItem($data){
        $this->id_use = $data['id'];
        $this->show_view = true;

        $this->name    = $data['name'];
        $this->phone   = $data['phone'];
        $this->address = $data['address'];
        $this->email   = $data['email'];
        $this->estatus = $data['estatus'];
        
    }

    public function clouseModal(){
        $this->id_use = '';
        $this->show = false;
    }

    

    public function update(){

        $this->name    = trim($this->name);
        $this->phone   = trim($this->phone);
        $this->address   = trim($this->address);
        $this->email   = trim($this->email);

        $this->validate();

        $user = Result::where('id', $this->id_use)->first();

        $user->update([
            'name'    => $this->name,
            'phone'   => $this->phone,
            'address' => $this->address,
            'email'   => $this->email,
            'estatus' => $this->estatus,
            'update_user_id' => auth()->user()->id
        ]);

        $this->show = false;
        $this->emit('render');
    }

    public function confirmation_delete($id, $nombre){

        $this->id_use = $id;
        $this->nombre_delete = $nombre;
        $this->show_confirmation_delete = true;

    }

    public function delete(){

        $eps = Result::where('id', $this->id_use)->first();
        
        if($user->user or $user->result){
            $this->show_confirmation_delete = false;
            $this->show_no_delete = true;
        }else{
            // $this->show_no_delete = true;
            // $this->nombre_delete = $nombre;
            $this->show_confirmation_delete = false;
            Result::where('id', $this->id_use)->delete();
        }

    }

    public function render()
    {
        // $data = Result::name($this->search)->paginate($this->per_page);
        $data = Result::paginate($this->per_page);

        return view('livewire.admin.result.result-list', compact('data'));
    }
}
