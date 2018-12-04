<?php

namespace SON\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SON\Forms\ClassInformationForm;
use SON\Http\Controllers\Controller;
use SON\Models\ClassInformation;

class ClassInformationsController extends Controller
{
    public function index()
    {
        $class_informations = ClassInformation::paginate();
        return view('admin.class_informations.index', compact('class_informations'));
    }

    public function create()
    {
        $form = \FormBuilder::create(ClassInformationForm::class,
            [
                'url' => route('admin.class_informations.store'),
                'method' => 'POST'
            ]
        );
        return view('admin.class_informations.create', compact('form'));
    }

    public function store(Request $request)
    {
        $form = \FormBuilder::create(ClassInformationForm::class);

        if (!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        ClassInformation::create($data);
        $request->session()->flash('message', 'Turma criada com sucesso');
        return redirect()->route('admin.class_informations.index');
    }

    public function show(ClassInformation $class_information)
    {
        return view('admin.class_informations.show', compact('class_information'));
    }

    public function edit(ClassInformation $class_information)
    {
        $form = \FormBuilder::create(ClassInformationForm::class,
            [
                'url' => route('admin.class_informations.update', ['class_informations' => $class_information->id]),
                'method' => 'PUT',
                'model' => $class_information
            ]
        );
        return view('admin.class_informations.edit', compact('form'));
    }

    public function update(ClassInformation $class_information)
    {
        $form = \FormBuilder::create(ClassInformationForm::class);

        if (!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $class_information->update($data);
        session()->flash('message', 'Turma editada com sucesso');
        return redirect()->route('admin.class_informations.index');
    }

    public function destroy(ClassInformation $class_information)
    {
        $class_information->delete();
        session()->flash('message', 'Turma excluída com sucesso');
        return redirect()->route('admin.class_informations.index');
    }
}