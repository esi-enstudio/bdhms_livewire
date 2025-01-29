<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Primary extends Component
{
    public string $title;
    public string $subtitle = '';
//    public string $description = '';
    public string|null $image = null;
    public string $showUrl = '#';
    public $deleteId;

    /**
     * OldCreate a new component instance.
     */
    public function __construct($title, $subtitle, $image, $showUrl, $deleteId)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
//        $this->description = $description;
        $this->image = $image;
        $this->showUrl = $showUrl;
        $this->deleteId = $deleteId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card.primary');
    }
}
