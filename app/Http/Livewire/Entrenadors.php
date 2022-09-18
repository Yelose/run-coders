<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Entrenador;

class Entrenadors extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $imagen, $nombre, $descripcion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.entrenadors.view', [
            'entrenadors' => Entrenador::latest()
						->orWhere('imagen', 'LIKE', $keyWord)
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
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
		$this->imagen = null;
		$this->nombre = null;
		$this->descripcion = null;
    }

    public function store()
    {
        $this->validate([
		'imagen' => 'required',
		'nombre' => 'required',
		'descripcion' => 'required',
        ]);

        Entrenador::create([ 
			'imagen' => $this-> imagen,
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Entrenador Successfully created.');
    }

    public function edit($id)
    {
        $record = Entrenador::findOrFail($id);

        $this->selected_id = $id; 
		$this->imagen = $record-> imagen;
		$this->nombre = $record-> nombre;
		$this->descripcion = $record-> descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'imagen' => 'required',
		'nombre' => 'required',
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Entrenador::find($this->selected_id);
            $record->update([ 
			'imagen' => $this-> imagen,
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Entrenador Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Entrenador::where('id', $id);
            $record->delete();
        }
    }
}
