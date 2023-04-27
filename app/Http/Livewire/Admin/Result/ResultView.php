<?php

namespace App\Http\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Admin\Eps;
use App\Models\Admin\Result;
use Livewire\WithFileUploads;

class ResultView extends Component
{

    use WithFileUploads;

    public $data;
    public $id_use;
    public $id_use_delete;

    public $files                    = [];
    public $show_confirmation_delete = false;

    public $age                      = '';
    public $name                     = '';
    public $code                     = '';
    public $email                    = '';
    public $eps_id                   = '';
    public $estatus                  = 1;
    public $patient_identification   = '';
    public $identification_type      = '';


    public $doc_result = [];
    public $imageId = 1;

    public function cleanUp()
    {
        $this->doc_result = [];
        $this->imageId = $this->imageId + 1;
    }

    protected $listeners = [
        'render', 
        'eps_created' => 'eps_created'
    ];

    public function eps_created($id){
        $this->eps_id = $id;
    }


    public function rules(){
        return [
            'code' => ['required', 'string', 'max:255', 'unique:results,code,'.$this->id_use],
            'patient_identification' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:results,email,'.$this->id_use],
            'age' => 'required',
            'eps_id' => 'required',
            'estatus' => 'required',
        ];
    }
    
    public function messages(){
        return [
        'code' => 'El campo codigo es obligatorio.',
        'patient_identification' => 'El campo Identificación del paciente es obligatorio.',
        'eps_id' => 'El campo Eps es obligatorio.',
        'age' => 'El campo Año es obligatorio.',
        ];
    }

    
    public function confirmation_delete($id){

        $this->id_use_delete = $id;
        $this->show_confirmation_delete = true;

    }

    public function delete_archive()
    {
        $f = delete_file($this->id_use_delete);

        if($f){
            $this->show_confirmation_delete = false;
            $this->render();
        }
    }

    public function get_data()
    {
        $data = Result::where('id', $this->id_use)->with('file')->first();

        if(is_null($data)) {
            return abort(404);
        }

        if ($data) {
            $this->files                  = $data->file;

            $this->age                    = $data->age;
            $this->name                   = $data->name;
            $this->code                   = $data->code;
            $this->email                  = $data->email;
            $this->eps_id                 = $data->eps_id;
            $this->estatus                = $data->estatus;
            $this->identification_type    = $data->identification_type;
            $this->patient_identification = $data->patient_identification;
        }
    }
    
    public function mount()
    {
        $this->get_data();
    }

    

    public function update()
    {
        $this->code                   = trim($this->code);
        $this->name                   = trim($this->name);
        $this->email                  = trim($this->email);
        $this->patient_identification = trim($this->patient_identification);
        $this->identification_type    = trim($this->identification_type);

        // dd($this->code);
        
        $this->validate();

        $data = Result::where('id', $this->id_use)->firstOrFail();
        // dd($data);

        $data->update([
            'age'                    => $this->age,
            'code'                   => $this->code,
            'name'                   => $this->name,
            'email'                  => $this->email,
            'eps_id'                 => $this->eps_id,
            'estatus'                => $this->estatus,
            'identification_type'    => $this->identification_type,
            'patient_identification' => $this->patient_identification,
            'update_user_id'         => auth()->user()->id
        ]);

        $files_doc = [];

        foreach ($this->doc_result as $doc) {
            $files_doc[]['url'] = $doc->store('doc_result');
        }

        if($files_doc){
            $data->file()->createMany($files_doc);
        }

        $this->cleanUp();
        $this->get_data();

        $this->emit('saved');
    }

    public function render()
    {
        $eps = Eps::where('estatus', 1)->get();
        return view('livewire.admin.result.result-view', compact('eps'));
    }
}
