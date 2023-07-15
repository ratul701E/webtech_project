<?php

    session_start();
    require_once('../model/queryModel.php');


    if(!isset($_SESSION['logged_in']) ) {
        header('location: signin.php');
        exit();
    }

    $user = $_SESSION['user'];

    if($user['role'] != 'Admin' and $user['role'] != 'SuperAdmin'){
        header('location: profile.php?username='.$user['username']);
        exit();
    }

    $success_msg = '';
    if(isset($_GET['success'])){
        $s_msg = $_GET['success'];
        switch($s_msg){
            case 'replySend':{$success_msg = "Reply send and query removed."; break;}
            case 'removed':{$success_msg = "Query removed."; break;}
            
        }   
    }

    $queries = getAllQuery();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Query</title>
</head>
<body>
  <?php require_once('top_navbar.php'); ?>
  <table align="center">
    <?php if(strlen($success_msg) > 0){ ?>
        <tr align="center">
            <td colspan="2"><font color="green"><?=$success_msg?></font></td>
        </tr>
    <?php } ?>
    <tr>
        <td>
            <fieldset>
                <legend align="center"><h3>Queries List</h3></legend>
                <table align="center" cellpadding="10">
                    <tr>
                    <th>Sender<br><hr> </th>
                    <th>First Few Words <br><hr> </th>
                    <th>Action <br><hr> </th>
                    </tr>
                    <?php
                        if(sizeof($queries) == 0){
                            ?>
                                <tr align="center">
                                    <td colspan="3">
                                        <b><i>Query list is empty</i></b>
                                    </td>
                                </tr>
                            <?php
                        }
                        else{
                            foreach ($queries as $query) {
                                $sender = $query['sender_email'];
                                $query_short = substr($query['query'], 0, length:20);
                                $query_id = $query['query_id'];
    
                                ?>
                                    <tr>
                                        <td> <?php echo $sender ?> </td>
                                        <td> <?php echo $query_short ?> </td>
                                        <td>
                                            <form action="../controller/manage_query_process.php" method="post">
    
                                                <input type="hidden" name="query_id" value="<?php echo $query_id ?>">
                                                <a href="view_query.php?qid=<?php echo $query_id ?>"><input type="button" value="View"></a>
                                                <input type="submit" name="remove" value="Remove">
    
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </fieldset>
        </td>
    </tr>
  </table>
</body>
</html>
