<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Enlace;

class Enlaces extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $imagen, $enlace;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.enlaces.view', [
            'enlaces' => Enlace::latest()
						->orWhere('imagen', 'LIKE', $keyWord)
						->orWhere('enlace', 'LIKE', $keyWord)
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
		$this->enlace = null;
    }

    public function store()
    {
        $this->validate([
		'imagen' => 'required',
		'enlace' => 'required',
        ]);

        Enlace::create([ 
			'imagen' => $this-> imagen,
			'enlace' => $this-> enlace
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Enlace Successfully created.');
    }

    public function edit($id)
    {
        $record = Enlace::findOrFail($id);

        $this->selected_id = $id; 
		$this->imagen = $record-> imagen;
		$this->enlace = $record-> enlace;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'imagen' => 'required',
		'enlace' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Enlace::find($this->selected_id);
            $record->update([ 
			'imagen' => $this-> imagen,
			'enlace' => $this-> enlace
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Enlace Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Enlace::where('id', $id);
            $record->delete();
        }
    }
}
