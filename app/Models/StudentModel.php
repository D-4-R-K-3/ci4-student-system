<?php

namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    // Fields that can be inserted/updated
    protected $allowedFields = ['student_number', 'first_name', 'last_name', 'email', 'course'];

    // Required for Step 9 of your lab
    protected $useSoftDeletes = true;


    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps   = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'student_number' => 'required|min_length[3]|max_length[50]',
        'first_name'     => 'required|min_length[2]|max_length[100]',
        'last_name'      => 'required|min_length[2]|max_length[100]',
        'email'          => 'required|valid_email|max_length[100]',
        'course'         => 'required|min_length[2]|max_length[100]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Check if email already exists (excluding current record if updating)
     */
    public function emailExists($email, $excludeId = null)
    {
        $query = $this->where('email', $email)->where('deleted_at', null);
        if ($excludeId) {
            $query->where('id !=', $excludeId);
        }
        return $query->first() !== null;
    }

    /**
     * Check if student number already exists (excluding current record if updating)
     */
    public function studentNumberExists($studentNumber, $excludeId = null)
    {
        $query = $this->where('student_number', $studentNumber)->where('deleted_at', null);
        if ($excludeId) {
            $query->where('id !=', $excludeId);
        }
        return $query->first() !== null;
    }
}
