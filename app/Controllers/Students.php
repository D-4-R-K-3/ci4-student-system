<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use CodeIgniter\HTTP\ResponseInterface;

class Students extends BaseController
{
    public function index()
    {
        $model = new StudentModel();
        $search = $this->request->getGet('search');

        if ($search) {
            // Futuristic multi-field scan logic
            $model->groupStart()
                    ->like('student_number', $search)
                    ->orLike('first_name', $search)
                    ->orLike('last_name', $search)
                    ->orLike('email', $search)
                    ->orLike('course', $search)
                  ->groupEnd();
        }

        // Returns filtered results or all results if no search is performed
        $data['students'] = $model->paginate(10);
        $data['pager'] = $model->pager;

        return view('students/index', $data);
    }

    public function create()
    {
        return view('students/create');
    }

    public function store()
    {
        $model = new StudentModel();
        $data = $this->request->getPost();

        // Validate input
        if (!$model->validate($data)) {
            return redirect()->back()->withInput()->with('validation', $model->errors());
        }

        // Check for duplicate email
        if ($model->emailExists($data['email'])) {
            return redirect()->back()->withInput()->with('error', 'Email already exists in the system');
        }

        // Check for duplicate student number
        if ($model->studentNumberExists($data['student_number'])) {
            return redirect()->back()->withInput()->with('error', 'Student number already exists in the system');
        }

        if ($model->save($data)) {
            return redirect()->to(site_url('students'))->with('success', 'Student added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to add student');
        }
    }

    public function edit($id)
    {
        $model = new StudentModel();
        $data['student'] = $model->find($id);
        
        if (!$data['student']) {
            return redirect()->to(site_url('students'))->with('error', 'Student not found');
        }
        
        return view('students/edit', $data);
    }

    public function update($id)
    {
        $model = new StudentModel();
        $data = $this->request->getPost();

        // Validate input
        if (!$model->validate($data)) {
            return redirect()->back()->withInput()->with('validation', $model->errors());
        }

        // Check for duplicate email (excluding current record)
        if ($model->emailExists($data['email'], $id)) {
            return redirect()->back()->withInput()->with('error', 'Email already exists in the system');
        }

        // Check for duplicate student number (excluding current record)
        if ($model->studentNumberExists($data['student_number'], $id)) {
            return redirect()->back()->withInput()->with('error', 'Student number already exists in the system');
        }

        if ($model->update($id, $data)) {
            return redirect()->to(site_url('students'))->with('success', 'Student updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update student');
        }
    }

    public function delete($id)
    {
        $model = new StudentModel();
        if ($model->delete($id)) {
            return redirect()->to(site_url('students'))->with('success', 'Student deleted successfully');
        } else {
            return redirect()->to(site_url('students'))->with('error', 'Failed to delete student');
        }
    }
}