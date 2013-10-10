<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_permission_descriptions extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;
		
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to login to the site' WHERE `name` = 'Site.Signin.Allow';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to login to the site when the site is offline' WHERE `name` = 'Site.Signin.Offline';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to view the Content Context' WHERE `name` = 'Site.Content.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to view the Reports Context' WHERE `name` = 'Site.Reports.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to view the Settings Context' WHERE `name` = 'Site.Settings.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to view the Developer Context' WHERE `name` = 'Site.Developer.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to manage the user Roles' WHERE `name` = 'Coffeeshop.Roles.Manage';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to delete user Roles' WHERE `name` = 'Coffeeshop.Roles.Delete';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to manage the site Users' WHERE `name` = 'Coffeeshop.Users.Manage';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users access to the User Settings' WHERE `name` = 'Coffeeshop.Users.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to add new Users' WHERE `name` = 'Coffeeshop.Users.Add';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to manage the Database settings' WHERE `name` = 'Coffeeshop.Database.Manage';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users access to the Emailer settings' WHERE `name` = 'Coffeeshop.Emailer.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to manage the Emailer settings' WHERE `name` = 'Coffeeshop.Emailer.Manage';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users access to the Log details' WHERE `name` = 'Coffeeshop.Logs.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = 'Allow users to manage the Log files' WHERE `name` = 'Coffeeshop.Logs.Manage';");
		
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;
		
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Site.Signin.Allow';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Site.Signin.Offline';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Site.Content.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Site.Reports.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Site.Settings.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Site.Developer.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Roles.Manage';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Roles.Delete';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Users.Manage';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Users.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Users.Add';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Database.Manage';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Emailer.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Emailer.Manage';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Logs.View';");
		$this->db->query("UPDATE {$prefix}permissions SET `description` = '' WHERE `name` = 'Coffeeshop.Logs.Manage';");
	}
	
	//--------------------------------------------------------------------
	
}