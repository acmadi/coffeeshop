<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Developer extends Admin_Controller
{

	//--------------------------------------------------------------------

	/**
	 * Sets up the permissions and loads the language file
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Site.Developer.View');
		$this->auth->restrict('Coffeeshop.Logs.View');

		$this->lang->load('logs');
		Template::set('toolbar_title', lang('log_title'));

		Template::set_block('sub_nav', 'developer/_sub_nav');

		// Logging enabled?
		Template::set('log_threshold', $this->config->item('log_threshold'));
	}//end __construct()

	//--------------------------------------------------------------------

	/**
	 * Lists all log files and allows you to change the log_threshold.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->helper('file');

		// Are we doing bulk actions?
		if (!empty($_POST))
		{
			$this->auth->restrict('Coffeeshop.Logs.Manage');

			if (isset($_POST['action_delete']))
			{
				$checked = $this->input->post('checked');

				if (is_array($checked) && count($checked))
				{
					foreach ($checked as $file)
					{
						@unlink($this->config->item('log_path') . $file);
						$activity_text = 'log file '.date('F j, Y', strtotime(str_replace('.php', '', str_replace('log-', '', $file))));
						$this->activity_model->log_activity($this->current_user->id, ucfirst($activity_text) . ' deleted from: ' . $this->input->ip_address(), 'logs');
					}

					Template::set_message(sprintf(lang('log_deleted'), count($checked)), 'success');
				}
			}
			elseif (isset($_POST['action_delete_all']))
			{
				delete_files($this->config->item('log_path'));
				// restore the index.html file
				@copy(APPPATH.'/index.html',$this->config->item('log_path').'/index.html');

				// Log the activity
				$activity_text = "all log files";
				$this->activity_model->log_activity($this->current_user->id, ucfirst($activity_text) . ' deleted from: ' . $this->input->ip_address(), 'logs');

				Template::set_message("Successfully deleted " . $activity_text, 'success');
			}
		}

		// Load the Log Files
		$logs = array_reverse(get_filenames($this->config->item('log_path')));

		// Pagination
		$this->load->library('pagination');

		$offset = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		//$limit = $this->limit;
		$limit = 10;

		$this->pager['base_url'] = site_url(SITE_AREA .'/developer/logs/index');
		$this->pager['total_rows'] = count($logs);
		$this->pager['per_page'] = $limit;
		$this->pager['uri_segment']	= 5;

		$this->pagination->initialize($this->pager);

		Template::set('logs', array_slice($logs, $offset, $limit));

		Template::render();

	}//end index()

	//--------------------------------------------------------------------

	/**
	 * Display the page which lets the user choose the logging threshold.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function settings()
	{
		$this->auth->restrict('Coffeeshop.Logs.Manage');

		Template::set('toolbar_title', lang('log_title_settings'));

		Template::render();

	}//end settings()

	//--------------------------------------------------------------------

	/**
	 * Saves the logging threshold value.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function enable()
	{
		$this->auth->restrict('Coffeeshop.Logs.Manage');

		if ($this->input->post('submit'))
		{
			$this->load->helper('config_file');

			if (write_config('config', array('log_threshold' => $_POST['log_threshold'])))
			{

				// Log the activity
				$this->activity_model->log_activity( intval ( $this->current_user->id ), 'Log settings modified from: ' . $this->input->ip_address(), 'logs');

				Template::set_message('Log settings successfully saved.', 'success');
			}
			else
			{
				Template::set_message('Unable to save log settings. Check the write permissions on <b>application/config.php</b> and try again.', 'error');
			}
		}

		redirect(SITE_AREA .'/developer/logs');

	}//end enable()

	//--------------------------------------------------------------------

	/**
	 * Shows the contents of a single log file.
	 *
	 * @access public
	 *
	 * @param string $file The full name of the file to view (including extension).
	 *
	 * @return void
	 */
	public function view($file='')
	{
		if (empty($file))
		{
			$file = $this->uri->segment(4);
		}

		if (empty($file))
		{
			Template::set_message('No log file provided.', 'error');
			Template::redirect(SITE_AREA .'/developer/logs');
		}

		Assets::add_module_js('logs', 'logs');

		Template::set('log_file', $file);
		Template::set('log_file_pretty', date('F j, Y', strtotime(str_replace('.php', '', str_replace('log-', '', $file)))));
		Template::set('log_content', file($this->config->item('log_path') . $file));
		Template::render();

	}//end view()

	//--------------------------------------------------------------------

}//end class
