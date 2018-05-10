<?php

namespace WeDevs\PM\Core\Permissions;

use WeDevs\PM\Core\Permissions\Abstract_Permission;
use WeDevs\PM\Task\Models\Task;
use WP_REST_Request;

class Edit_Task extends Abstract_Permission {
   
    public function check() {
        $id = $this->request->get_param( 'task_id' );
        $project_id = $this->request->get_param( 'project_id' );
        $user_id = get_current_user_id();

        if ( $user_id ) {

        	if ( $project_id && pm_is_manager( $project_id, $user_id ) ) {
	            return true;
	        }
	        if ( Task::find( $id )->created_by == $user_id ){
	        	return true;
	        }

        }

        return new \WP_Error( 'TaskList', __( "You have no permission.", "pm" ) );
    }
}