<?php

namespace App\Repositories;

use App\Models\Document;

class Documents
{
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function all()
    {
        return $this->document->all();
    }

    public function latest()
    {
        return $this->document->take(10)->orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return $this->document->find($id);
    }

    public function create($input)
    {
        $this->document->create($input);
    }

    public function update($reference)
    {
        $document = $this->document->whereReference($reference)->first();
        $document->path = $reference.'.pdf';
        $document->save();
    }

    public function truncate()
    {
        $this->document->truncate();
    }
}
