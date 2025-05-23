<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $userData = array())
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = auth()->user();
        $this->userData = [
            'username' => $user->nama,
            'email' => $user->email,
            'level' => $user->level,
        ];

        if ($user['level'] === 'admin') {
            return view('components.sidebaradmin', [
                'userData' => $this->userData,
            ]);
        } else {
            return view('components.sidebar', [
                'userData' => $this->userData,
            ]);
        }
    }
}
