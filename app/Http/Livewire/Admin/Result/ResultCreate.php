<?php

namespace App\Http\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Admin\Eps;
use App\Models\Admin\Result;
use Livewire\WithFileUploads;
use Livewire\FileUploadConfiguration;
use Illuminate\Support\Facades\Storage;

class ResultCreate extends Component
{

    use WithFileUploads;

    protected $listeners = [
        'render', 
        'eps_created' => 'eps_created'
    ];

    public $doc_result = [];


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

    public $imageId = 1;

    public function eps_created($id){
        $this->eps_id = $id;
    }
    
    protected $rules = [
        'code' => ['required', 'string', 'max:255', 'unique:results'],
        'patient_identification' => ['required', 'string', 'max:255'],
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:results'],
        'age' => 'required',
        'eps_id' => 'required',
        'estatus' => 'required',
    ];
    
    protected $messages = [
        'code.required' => 'El campo codigo es obligatorio.',
        'code.unique' => 'Este codigo ya esta en uso.',
        'patient_identification' => 'El campo Identificación del paciente es obligatorio.',
        'eps_id' => 'El campo Eps es obligatorio.',
        'age' => 'El campo Año es obligatorio.',
    ];

    public function reset_data()
    {
        $this->age = '';
        $this->code = '';
        $this->name = '';
        $this->email = '';
        $this->eps_id = '';
        $this->patient_identification = '';
        $this->identification_type = '';
        $this->estatus = 1;
    }

    protected function cleanupOldUploads()
    {
        if (FileUploadConfiguration::isUsingS3()) return;

        $storage = FileUploadConfiguration::storage();

        foreach ($storage->allFiles(FileUploadConfiguration::path()) as $filePathname) {
            // On busy websites, this cleanup code can run in multiple threads causing part of the output
            // of allFiles() to have already been deleted by another thread.
            if (! $storage->exists($filePathname)) continue;

            $yesterdaysStamp = now()->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
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

    public function cleanUp()
    {
        $this->doc_result = null;
        $this->imageId++;
    }

    public function create()
    {
        $this->code                   = trim($this->code);
        $this->name                   = trim($this->name);
        $this->email                  = trim($this->email);
        $this->patient_identification = trim($this->patient_identification);
        $this->identification_type    = trim($this->identification_type);

        // dd($this->doc_result);
        

        $this->validate();

        $result = Result::create([
            'age'                    => $this->age,
            'code'                   => $this->code,
            'name'                   => $this->name,
            'email'                  => $this->email,
            'eps_id'                 => $this->eps_id,
            'estatus'                => $this->estatus,
            'identification_type'    => $this->identification_type,
            'patient_identification' => $this->patient_identification,
            'user_id'                => auth()->user()->id,
            'update_user_id'         => auth()->user()->id
        ]);

        $files_doc = [];

        foreach ($this->doc_result as $doc) {
            $files_doc[]['url'] = $doc->store('doc_result');
        }

        if($files_doc){
            $result->file()->createMany($files_doc);
        }

        $this->cleanUp();


        $this->reset_data();

        $this->emit('render');
        $this->show = false;
    }

    public function render()
    {
        $eps = Eps::where('estatus', 1)->get();
        return view('livewire.admin.result.result-create', compact('eps'));
    }
}
