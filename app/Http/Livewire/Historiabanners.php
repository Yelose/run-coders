<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Historiabanner;

class Historiabanners extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $imagen, $descripcion, $origen;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.historiabanners.view', [
            'historiabanners' => Historiabanner::latest()
						->orWhere('imagen', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('origen', 'LIKE', $keyWord)
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
		$this->descripcion = null;
		$this->origen = null;
    }

    public function store()
    {
        $this->validate([
		'imagen' => 'required',
		'descripcion' => 'required',
		'origen' => 'required',
        ]);

        Historiabanner::create([ 
			'imagen' => $this-> imagen,
			'descripcion' => $this-> descripcion,
			'origen' => $this-> origen
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Historiabanner Successfully created.');
    }

    public function edit($id)
    {
        $record = Historiabanner::findOrFail($id);

        $this->selected_id = $id; 
		$this->imagen = $record-> imagen;
		$this->descripcion = $record-> descripcion;
		$this->origen = $record-> origen;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'imagen' => 'required',
		'descripcion' => 'required',
		'origen' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Historiabanner::find($this->selected_id);
            $record->update([ 
			'imagen' => $this-> imagen,
			'descripcion' => $this-> descripcion,
			'origen' => $this-> origen
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Historiabanner Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Historiabanner::where('id', $id);
            $record->delete();
        }
    }
}
