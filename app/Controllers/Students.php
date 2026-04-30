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
        $model->save($this->request->getPost());
        return redirect()->to(site_url('students'));
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
        $model->update($id, $this->request->getPost());
        return redirect()->to(site_url('students'));
    }

    public function delete($id)
    {
        $model = new StudentModel();
        $model->delete($id);
        return redirect()->to(site_url('students'));
    }
}