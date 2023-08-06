<?php
if (! defined ( "IN_ESOTALK" ))
	exit ();
class ConfigAdminController extends ETAdminController {
	protected function plugin() {
		return ET::$plugins ["ConfigEditor"];
	}
	/*
	 * The index page.
	 * @return void
	 */
	public function action_index() {
		$form = ETFactory::make ( "form" );
		$form->action = URL ( "admin/config_editor/save" );
		$config = file_get_contents ( PATH_CONFIG . '/config.php' );
		if(R("loadbackup") == '1'){
			if ($c = file_get_contents ( PATH_CONFIG . '/config_backup.php' )){
				$config = $c;
				$this->message("The last backup was loaded.", "success");
			}else{
				$this->message("Backup not found.", "error");
			}
			
		}
		$form->setValue ( "content", $config );
		$this->data ( "form", $form );
		$this->title = "Edit config.php";
		$this->render ( $this->plugin ()->view ( "admin/edit" ) );
	}
	/*
	 * Save the config.php file and the backup.
	 * @return void 
	 */
	public function action_save() {
		if (! $this->validateToken ())
			return;
		$config = @file_get_contents ( PATH_CONFIG . '/config.php' );
		$config_backup = @file_get_contents ( PATH_CONFIG . '/config_backup.php' );
		$message = '';
		if($config && $config != $config_backup){
			// backup before saving
			if(file_force_contents(PATH_CONFIG. '/config_backup.php', $config))
				$message .= 'and saved a backup.';
		}
		if($content = R("content")){
			if(file_force_contents(PATH_CONFIG. '/config.php', $content)){
                //in SAE
                if(!empty($_SERVER['HTTP_APPNAME'])){
                    $kv = new SaeKV();
					// Initialize the SaeKV object
					$kv->init();
					// delete key-value
    				$kv->delete('site_config');
                }
				$this->message("config.php was written successfully!".$message, "success");
			}else{
				$this->message("config.php write failed!", "error");
            }
		}
		$this->redirect ( URL ( "admin/config_editor" ) );
	}
}
