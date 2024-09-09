<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

class cardNDE extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name = '',
        public string $description = '',
        public string $displayEdit = 'hidden',
        public string $displayDelete = 'hidden',
        public string $href = '#',
        public string $id = '',
        public string $editModal = '',
        public string $deleteModal = '',
        public string $displayExFoot = 'hidden',
        public string $type = '',
        public string $points = '',
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->displayEdit = $editModal == '' ? 'hidden' : 'inline-flex';
        $this->displayDelete = $deleteModal == '' ? 'hidden' : 'inline-flex';
        $this->href = $href;
        $this->id = $id == '' ? '' : 'id = ' . $id;
        $this->editModal = $editModal == '' ? '' : 'data-modal-target=' . $editModal . ' data-modal-toggle=' . $editModal;
        $this->deleteModal = $deleteModal == '' ? '' : 'data-modal-target=' . $deleteModal . ' data-modal-toggle=' . $deleteModal;
        $this->displayExFoot = (($type != '') or ($points != '')) ? 'inline-flex' : 'hidden';
        $this->type = $type;
        $this->points = $points;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-n-d-e');
    }
}
