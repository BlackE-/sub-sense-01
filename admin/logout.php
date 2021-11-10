<script>
    sessionStorage.clear();
</script>

<?php
    require_once dirname(__FILE__) . '/include/_subsense.php';
	$set = new Subsense();
    if($set->Logout()){
        $set->RedirectToURL("login");
    }
?>