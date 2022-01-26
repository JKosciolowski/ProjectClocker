<?php

class EditController extends Controller
{
    private \Database $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function edit()
    {
        $data = [
            'project_name' => ''
        ];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_POST = filter_input_array(INPUT_POST);
            $data = [
                'project_name' => trim($_POST['project_name'])
            ];
            $this->db->query('UPDATE projects SET project_name = :project_name WHERE id = :id');
            $this->db->bind(':project_name', $data['project_name']);
            $this->db->bind(':id', $_SESSION['tid']);
            $this->db->execute();
        }
        $this->db->query('SELECT * FROM projects WHERE id = :id');
        $this->db->bind(':id', $_SESSION['tid']);
        $this->db->execute();
        $project = $this->db->fetchAll();
        $this->view('edit', $project);
    }
}