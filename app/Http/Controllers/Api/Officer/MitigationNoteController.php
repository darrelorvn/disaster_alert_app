<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class MitigationNoteController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.Officer.MitigationNote.index');
}

public function store()
{
    return $this->todo('Api.Officer.MitigationNote.store');
}

public function show()
{
    return $this->todo('Api.Officer.MitigationNote.show');
}

public function update()
{
    return $this->todo('Api.Officer.MitigationNote.update');
}

public function destroy()
{
    return $this->todo('Api.Officer.MitigationNote.destroy');
}
}
