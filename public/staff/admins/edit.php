<?php
    
    require_once('../../../private/initialize.php');
    require_login();
    
        if(!isset($_GET['id'])){
        redirect_to(url_for('/staff/admins/index.php'));
        }
        
        $id = $_GET['id'];
        $admin = Admin::find_by_id($id);
        
        if($admin == false){
        redirect_to(url_for('/staff/admins/index.php'));
            
        }
        
        if(is_post_request()){
        
        $args = $_POST['admin'];
        $admin->merge_attributes($args);
        $result = $admin->save();
        
        if($result === true){
            $session->message['The admin was updated successfully!'];
//$_SESSION['message'] = "The admin was updated successfully!";
            redirect_to(url_for('/staff/admins/show.php?id=' . $id));
        }else{
            //show errors
        }
        }else{
            //$admin = new Admin;
        }
        ?>

<?php $page_title = 'Edit admin'; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">Back to list</a>
    <div class="admin edit">
        <h1>Edit admin</h1>
        <?php echo display_errors($admin->errors); ?>
        <form action="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
            <?php include('form_fields.php'); ?>
            <div id="operations">
                <input type="submit" value="Edit admin" />
            </div>
        </form>
    </div>
</div>
    
   

<?php include(SHARED_PATH . '/staff_footer.php'); ?>