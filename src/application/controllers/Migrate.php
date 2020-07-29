<?php defined("BASEPATH") or exit("No direct script access allowed");



class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }
    public function index()
    {
        if(!$this->migration->latest())
        {
            show_error($this->migration->error_string());
        }else echo "Migrations has been done!";
    }
    public function version()
    {
        $version = $this->input->get(null, TRUE)['v'];
        $migration = $this->migration->version($version);
        if(!$migration)
        {
            echo $this->migration->error_string();
        }
        else
        {
            echo 'Migration(s) done'.PHP_EOL;
        }

    }
    public function reset()
    {

        if($this->migration->current()!== FALSE)
        {
            echo 'The migration was reset to the version set in the config file.';
            return TRUE;
        }
        else
        {
            echo 'Couldn\'t reset migration.';
            show_error($this->migration->error_string());
            exit;
        }
    }
}