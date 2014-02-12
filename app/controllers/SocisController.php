<?php

class SocisController extends BaseController
{
    public function index()
    {
        // Show a listing of socis.
	$socis = Soci::all();
	return View::make('index', compact('socis')); 
	//return View::make('index');
   }

    public function create()
    {
        // Show the create socis form.
        return View::make('create');
    }

    public function handleCreate()
    {
        // Handle create form submission.
    }

    public function edit(Soci $soci)
    {
        // Show the edit game form.
        return View::make('edit');
    }

    public function handleEdit()
    {
        // Handle edit form submission.
    }

    public function delete()
    {
        // Show delete confirmation page.
        return View::make('delete');
    }

    public function handleDelete()
    {
        // Handle the delete confirmation.
    }
}
 ?>