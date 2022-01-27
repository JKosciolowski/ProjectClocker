<?php

class DeleteController extends Controller
{
    private \Database $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function delete(){

    
        $this->db->query('DELETE FROM projects WHERE id = :id');
        $this->db->bind(':id', $_GET['id']);
        $this->db->execute();

        $this->db->query('SELECT start_date, project_name, id as projectId FROM projects WHERE user_id = :user_id AND finished = 0');
        $this->db->bind(':user_id', (int)$_SESSION['user_id']);
        $this->db->execute();
        $projects_in_progress = $this->db->fetch();
        $this->db->query('SELECT * FROM projects WHERE user_id = :user_id AND finished = 1');
        $this->db->bind(':user_id', (int)$_SESSION['user_id']);
        $this->db->execute();
        $archived_projects = $this->db->fetchAll();
        $this->view = $this->view('Timer', ['project_in_progress' => $projects_in_progress, 'archived_projects' => $archived_projects]);
        
    }
}