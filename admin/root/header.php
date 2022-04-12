<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <?php 
    $search = empty($_GET['search']) ? '' : $_GET['search'];
    $search = validate($search);?>
    <div class="header">
        <div class="search-wrapper">
            <span class="fa fa-search"> </span>
            <form method="get" action="">
                <input placeholder="Search" name="search" type="search" value="<?php echo  $search?>">
            </form>

        </div>

        <div class="user-wrapper">
            <img src="https://s199.imacdn.com/vg/2022/04/10/8bcc6cebc2229dae_990cdd397c84a2b2_2480616495262419118684.jpg" alt="anh">
            <div>
                <h4>Hikky nè</h4>
                <small>Super admin</small>
            </div>
        </div>
    </div>

	

</body>
</html>