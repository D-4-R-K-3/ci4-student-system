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
        // Combined with Step 7: Pagination
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
        return redirect()->to('/students');
    }

    public function edit($id)
    {
        $model = new StudentModel();
        $data['student'] = $model->find($id);
        
        if (!$data['student']) {
            return redirect()->to('/students')->with('error', 'Student not found');
        }
        
        return view('students/edit', $data);
    }

    public function update($id)
    {
        $model = new StudentModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to('/students');
    }

    public function delete($id)
    {
        $model = new StudentModel();
        $model->delete($id);
        return redirect()->to('/students');
    }
}
