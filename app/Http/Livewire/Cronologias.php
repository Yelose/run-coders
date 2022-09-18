<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cronologia;

class Cronologias extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $fecha, $titulo, $texto;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.cronologias.view', [
            'cronologias' => Cronologia::latest()
						->orWhere('fecha', 'LIKE', $keyWord)
						->orWhere('titulo', 'LIKE', $keyWord)
						->orWhere('texto', 'LIKE', $keyWord)
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
		$this->fecha = null;
		$this->titulo = null;
		$this->texto = null;
    }

    public function store()
    {
        $this->validate([
		'fecha' => 'required',
		'titulo' => 'required',
		'texto' => 'required',
        ]);

        Cronologia::create([ 
			'fecha' => $this-> fecha,
			'titulo' => $this-> titulo,
			'texto' => $this-> texto
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Cronologia Successfully created.');
    }

    public function edit($id)
    {
        $record = Cronologia::findOrFail($id);

        $this->selected_id = $id; 
		$this->fecha = $record-> fecha;
		$this->titulo = $record-> titulo;
		$this->texto = $record-> texto;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'fecha' => 'required',
		'titulo' => 'required',
		'texto' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Cronologia::find($this->selected_id);
            $record->update([ 
			'fecha' => $this-> fecha,
			'titulo' => $this-> titulo,
			'texto' => $this-> texto
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Cronologia Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Cronologia::where('id', $id);
            $record->delete();
        }
    }
}
