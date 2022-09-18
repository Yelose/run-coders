<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Atleta;

class Atletas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $apellidos, $licencia;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.atletas.view', [
            'atletas' => Atleta::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('apellidos', 'LIKE', $keyWord)
						->orWhere('licencia', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->apellidos = null;
		$this->licencia = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'apellidos' => 'required',
		'licencia' => 'required',
        ]);

        Atleta::create([ 
			'nombre' => $this-> nombre,
			'apellidos' => $this-> apellidos,
			'licencia' => $this-> licencia
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Atleta Successfully created.');
    }

    public function edit($id)
    {
        $record = Atleta::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->apellidos = $record-> apellidos;
		$this->licencia = $record-> licencia;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'apellidos' => 'required',
		'licencia' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Atleta::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'apellidos' => $this-> apellidos,
			'licencia' => $this-> licencia
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Atleta Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Atleta::where('id', $id);
            $record->delete();
        }
    }
}
