<?php

namespace SON\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SON\Forms\SubjectForm;
use SON\Http\Controllers\Controller;
use SON\Models\Subject;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $form = \FormBuilder::create(SubjectForm::class,
            [
                'url' => route('admin.subjects.store'),
                'method' => 'POST'
            ]
        );
        return view('admin.subjects.create', compact('form'));
    }

    public function store(Request $request)
    {
        $form = \FormBuilder::create(SubjectForm::class);

        if (!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        Subject::create($data);
        $request->session()->flash('message', 'Disciplina criada com sucesso');
        return redirect()->route('admin.subjects.index');
    }

    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $form = \FormBuilder::create(SubjectForm::class,
            [
                'url' => route('admin.subjects.update', ['subject' => $subject->id]),
                'method' => 'PUT',
                'model' => $subject
            ]
        );
        return view('admin.subjects.edit', compact('form'));
    }

    public function update(Subject $subject)
    {
        $form = \FormBuilder::create(SubjectForm::class);

        if (!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $subject->update($data);
        session()->flash('message', 'Disciplina editada com sucesso');
        return redirect()->route('admin.subjects.index');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        session()->flash('message', 'Disciplina excluída com sucesso');
        return redirect()->route('admin.subjects.index');
    }
}